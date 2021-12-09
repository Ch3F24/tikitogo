<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Address;
use App\Models\Option;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Notifications\OrderResponse;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    protected $cartService;

    /**
     * CartController constructor.
     * @param $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function addToCart(CartItemRequest $request)
    {
        if ($request->has('option')) {
            $option = Option::find($request->option);
        } else {
            $option = null;
        }

        $product = Product::query()->findOrFail($request['product']);

        $this->cartService->add($product,$request->get('menu_date'),$option);

        $cart = session()->get('shopping-cart');

        return response()->json(['itemsInCart' => count($cart)]);
//        return redirect()->route('home');
    }

    public function index()
    {
        $cart = session()->get('shopping-cart');
        $total = session()->get('cart-total');
        $shipping = $this->cartService->setShipping($total);

        clock($shipping);

        if (Auth::check()) {
            $user = User::query()->with('address')->findOrFail(auth()->id());
        } else {
            $user = [];
        }

        return view('cart.index',compact('cart','total','user','shipping'));
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item' => 'required|integer'
        ]);
        $this->cartService->remove($request->item);

        return redirect()->route('cart.index');
    }

    public function checkout(CheckoutRequest $request)
    {
        $input = $request->except('item','_token');
        $user = $request->user();
        $input['user_id'] = $user->id;

        if (isset($input['same_as_shipping'])) {
            $input['billing_name'] = $input['name'];
            $input['billing_city'] = 'Budapest';
            $input['billing_postal_code'] = $input['shipping_postal_code'];
            $input['billing_address'] = $input['shipping_address'];
        }

        if (!$user->address()->exists()) {
            $user->address()->create($input);
        } else {
            $user->address->update($input);
        }

        if($request->has('take_away')) {
            if (!session()->has('take_away')) session()->push('take_away',$request->pickup_date);
            if (session()->has('shipping')) session()->forget('shipping');
        } else {
            if (session()->has('take_away')) session()->forget('take_away');
        }

        $checkout = $this->cartService->checkout($user);
        return redirect($checkout);
    }

    public function checkoutResponse(Request $request)
    {
        $user = Auth::user();
        $payment = $this->cartService->getOrder($request->get('paymentId'));

        if ($payment->Status == 'Succeeded') {
            $order = $this->cartService->createOrder($user,$payment);
            $this->cartService->forgetCart();

            Notification::route('mail','tikirendeles@gmail.com')
                ->notify(new OrderNotification($order));

            Notification::route('mail',$user->email)->notify(new OrderResponse());

            return redirect()->route('order.response')->with(['order' => $payment]);
        } else {
            return redirect()->route('cart.index');
        }
    }
}
