<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use LaravelHungary\Barion\Barion;
use LaravelHungary\Barion\Enums\Currency;
use LaravelHungary\Barion\Enums\FundingSource;
use LaravelHungary\Barion\Enums\Locale;
use LaravelHungary\Barion\Enums\PaymentType;

class CartService
{
    const CART = 'shopping-cart';
    const TOTAL_PRICE = 'cart-total';
    const SHIPPING = 'shipping';
    const SHIPPPING_PRICE = 400;

    protected $session;
    protected $barion;

    /**
     * CartService constructor.
     * @param SessionManager $session
     * @param Barion $barion
     */
    public function __construct(SessionManager $session,Barion $barion)
    {
        $this->session = $session;
        $this->barion = $barion;
    }

    public function add(Product $product,$menu_date,$option = null)
    {
        $cartItem = $this->createCartItem($product,$menu_date,$option);

        $cart = $this->getCart();

        $cart->push($cartItem);

        $this->session->put(self::CART,$cart);
        $this->calcTotalCart();
    }

    public function createCartItem(Product $product,$menu_date,$option)
    {
        return collect([
           'name' => $product->title,
           'product' => $product->id,
           'price' => $product->gross_price,
           'menu_date' => $menu_date,
           'option' => $option,
        ]);
    }

    public function getCart()
    {
        return $this->session->has(self::CART) ? $this->session->get(self::CART) : collect([]);
    }

    public function remove($id)
    {
        $cart = $this->getCart();

        if ($cart->has($id)) {
            $this->session->put(self::CART, $cart->except($id));
        }
        $this->calcTotalCart();

        if (count($this->session->get(self::CART)) === 0) {
            $this->forgetCart();
        }
    }

    public function calcTotalCart()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $key => $item) {
            $total += $item['price'];

            if ($item['option']) {
                $total += $item['option']['gross_price'];
            }
        }
        $this->setShipping($total);
        $this->session->put(self::TOTAL_PRICE,$total);
    }

    public function checkFinalPrice()
    {
        $cart = $this->getCart();
        $total = intval($this->session->get(self::TOTAL_PRICE));

        $reCalcTotal = 0;

        foreach ($cart as $key => $item) {
            $reCalcTotal += $item['price'];

            if ($item['option']) {
                $reCalcTotal += $item['option']['gross_price'];
            }
        }

        if (intval($reCalcTotal) !== $total) {
            abort(422, "Incorrect final price");
        }
    }

    public function checkout(User $user)
    {
        $this->checkFinalPrice();

        $cart = $this->getCart();
        $total = intval($this->session->get(self::TOTAL_PRICE));
        $lastOrder = Order::all()->count() + 1;
        $orderNumber = 'TI'. str_pad($lastOrder , 5, 0, STR_PAD_LEFT);

        $items = collect();

        foreach ($cart as $key => $item) {
            $product = Product::findOrFail($item['product']);

            $items->push($this->createItem($product));

            if ($item['option']) {
                $items->push($this->createItem($item['option']));
            }
        }
        if ($this->session->has(self::SHIPPING)) {
            $shipping = $this->session->get(self::SHIPPING);
            $items->push($shipping);
            $total += $shipping['UnitPrice'];
        }

        $payment = $this->barion->paymentStart([
            'PaymentType' => PaymentType::IMMEDIATE,
            'GuestCheckOut' => true,
            'FundingSources' => [FundingSource::ALL],
            'RedirectUrl' => route('cart.checkout.response'),
            'Locale' => Locale::HU,
            'Currency' => Currency::HUF,
            'CardHolderNameHint' => $user->address->billing_name,
            'PayerHint' => $user->email,
            'OrderNumber' => $orderNumber,
            'Transactions' => [
                [
//                    'POSTransactionId' => 'ABC-1234',
                    'Payee' => App::environment('production') ? 'tikibeachbisztro@gmail.com' : 'russhh24@gmail.com',
                    'Total' => $total,
                    'Items' => $items
                ]
            ]
        ]);

        if (empty($payment->Errors)) {
            return $payment->GatewayUrl;
        } else {
            clock($payment);
        }

    }

    public function createItem($product)
    {
        return collect([
            'Id' => $product->id,
            'Name' => $product->title,
            'Description' => $product->description ?? 'Étel a Tiki to go weboldalról.',
            'Quantity' => 1,
            'Unit' => 'db',
            'UnitPrice' => $product->gross_price,
            'ItemTotal' => $product->gross_price
        ]);
    }

    public function createShippingItem()
    {
        return collect([
            'Name' => 'Szállítás',
            'Description' => 'Szállítási összeg',
            'Quantity' => 1,
            'Unit' => 'db',
            'UnitPrice' => self::SHIPPPING_PRICE,
            'ItemTotal' => self::SHIPPPING_PRICE
        ]);
    }

    public function createOrder(User $user,$payment)
    {
        $cart = $this->getCart();
//        $payment = $this->barion->getPaymentState($paymentId);

        $order = Order::query()->create([
            'payment_id' => $payment->PaymentId,
            'order_number' => $payment->OrderNumber,
            'total_gross_price' => $payment->Total,
            'status' => $payment->Status,
            'name' => $user->address->name,
            'shipping_postal_code' => $user->address->shipping_postal_code,
            'shipping_address' => $user->address->shipping_address,
            'billing_name' => $user->address->billing_name,
            'vat_number' => $user->address->vat_number,
            'billing_postal_code' => $user->address->billing_postal_code,
            'billing_address' => $user->address->billing_address,
            'billing_city' => $user->address->billing_city,
            'phone' => $user->address->phone,
            'user_id' => $user->id
        ]);

        foreach ($cart as $key => $item) {
            $order->products()->create([
                'product_id' => $item['product'],
                'option_id' => isset($item['option']['id']) ?? null,
                'menu_date' => $item['menu_date']
            ]);
        }
        return $order;
    }

    public function forgetCart()
    {
        $this->session->forget(self::CART);
        $this->session->forget(self::TOTAL_PRICE);
        $this->session->forget(self::SHIPPING);
    }

    public function getOrder($paymentId)
    {
        return $this->barion->getPaymentState($paymentId);
    }

    public function setShipping($total)
    {
        if ( $total < 8000) {
            if (!$this->session->has(self::SHIPPING)) $this->session->put(self::SHIPPING,$this->createShippingItem());
        } else {
            return $this->session->has(self::SHIPPING) ? $this->session->forget(self::SHIPPING) : null;
        }
    }



}
