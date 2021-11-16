<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $shoppingCart = $request->session()->get('shopping-cart');
        $cartTotal = $request->session()->get('cart-total');

        $request->session()->regenerate();

        $request->session()->put('shopping-cart',$shoppingCart);
        $request->session()->put('cart-total',$cartTotal);

        if ($request->session()->has('shopping-cart')) {
            return redirect()->route('cart.index');
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $shoppingCart = $request->session()->get('shopping-cart');
        $cartTotal = $request->session()->get('cart-total');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->put('shopping-cart',$shoppingCart);
        $request->session()->put('cart-total',$cartTotal);

        return redirect('/');
    }
}
