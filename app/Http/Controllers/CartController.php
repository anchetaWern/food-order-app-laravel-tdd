<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\CartService;

class CartController extends Controller
{

    public function index(CartService $cart)
    {
        $cart_items = $cart->get();
        return view('cart', compact('cart_items'));
    }


    public function store(CartService $cart)
    {
        $cart->add(request('id'));
          return redirect('/cart');
    }


    public function destroy(CartService $cart)
    {
        $id = request('id');
        $cart->remove($id);

        return redirect('/cart');
    }


    public function update(CartService $cart)
    {
        $cart->update(request('id'), request('qty'));
        return redirect('/cart');
    }
}
