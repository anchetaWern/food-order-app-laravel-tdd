<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Services\CartService;

class CheckoutController extends Controller
{
    public function index(CartService $cart)
    {
        $checkout_items = $cart->get();
        $total = $cart->total();

        return view('checkout', compact('checkout_items', 'total'));
    }


    public function create(CartService $cart)
    {
        $checkout_items = $cart->get();
        $total = $cart->total();

        $order = Order::create([
            'total' => $total,
        ]);

        foreach ($checkout_items as $item) {
            $order->detail()->create([
                'product_id' => $item['id'],
                'cost' => $item['cost'],
                'qty' => $item['qty'],
            ]);
        }

        return redirect('/summary');
    }
}
