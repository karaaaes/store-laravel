<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        return view('pages.cart', [
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id){
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
