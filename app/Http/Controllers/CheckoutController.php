<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Product::whereIn('id', collect(session('cart'))->pluck('id'))->get();
        $checkout_items = collect(session('cart'))->map(function ($row, $index) use ($items) {
            $qty = (int) $row['qty'];
            $cost = (float) $items[$index]->cost;
            $subtotal = $cost * $qty;

            return [
                'id' => $row['id'],
                'qty' => $qty,
                'name' => $items[$index]->name,
                'cost' => $cost,
                'subtotal' => round($subtotal, 2),
            ];
        });

        $total = $checkout_items->sum('subtotal');
        $checkout_items = $checkout_items->toArray();

        return view('checkout', compact('checkout_items', 'total'));
    }


    public function create()
    {
        $items = Product::whereIn('id', collect(session('cart'))->pluck('id'))->get();
        $checkout_items = collect(session('cart'))->map(function ($row, $index) use ($items) {
            $qty = (int) $row['qty'];
            $cost = (float) $items[$index]->cost;
            $subtotal = $cost * $qty;

            return [
                'id' => $row['id'],
                'qty' => $qty,
                'name' => $items[$index]->name,
                'cost' => $cost,
                'subtotal' => round($subtotal, 2),
            ];
        });

        $total = $checkout_items->sum('subtotal');

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
