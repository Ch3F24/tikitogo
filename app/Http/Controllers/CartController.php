<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\Address;
use App\Models\Option;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($request->has('option_id')) {
            $option = Option::query()->where('id',$request->option_id)->first();
        } else {
            $option = null;
        }
        $product = Product::query()->findOrFail($request['product']);

        $this->cartService->add($product, $option);

        return redirect()->route('home');
    }

    public function index()
    {
        $cart = session()->get('shopping-cart');
        $total = session()->get('cart-total');

        if (Auth::check()) {
            $user = auth()->user()->with('address')->first();
        } else {
            $user = [];
        }

        return view('cart.index',compact('cart','total','user'));
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

        $checkout = $this->cartService->checkout($user);

        return redirect($checkout);
    }

    public function checkoutResponse(Request $request)
    {
        $user = Auth::user();
        $payment = $this->cartService->getOrder($request->get('paymentId'));

        if ($payment->Status == 'Succeeded') {
            $this->cartService->createOrder($user,$payment);
            $this->cartService->forgetCart();
            return redirect()->route('order.response')->with(['order' => $payment]);
        } else {
            return redirect()->route('cart.index');
        }
    }
}
