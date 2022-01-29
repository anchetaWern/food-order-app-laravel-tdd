<?php

namespace App\Services;

use App\Models\Product;

class CartService {

    private $cart;
    private $items;

    public function __construct()
    {
        $this->cart = collect(session('cart'));
        $this->items = Product::whereIn('id', $this->cart->pluck('id'))->get();
    }


    public function get()
    {
        return $this->cart->map(function ($row, $index) {
            $qty = (int) $row['qty'];
            $cost = (float) $this->items[$index]->cost;
            $subtotal = $cost * $qty;

            return [
                'id' => $row['id'],
                'qty' => $qty,
                'name' => $this->items[$index]->name,
                'image' => $this->items[$index]->image,
                'cost' => $cost,
                'subtotal' => round($subtotal, 2),
            ];
        })->toArray();
    }


    public function total()
    {
        $items = collect($this->get());
        return $items->sum('subtotal');
    }


    private function exists($id)
    {
        return $this->cart->first(function ($row, $key) use ($id) {
            return $row['id'] == $id;
        });
    }


    public function add($id)
    {
        $existing = $this->exists($id);

        if (!$existing) {
            session()->push('cart', [
                'id' => $id,
                'qty' => 1,
            ]);
            return true;
        }

        return false;
    }


    public function remove($id)
    {
        $items = $this->cart->filter(function ($item) use ($id) {
            return $item['id'] != $id;
        })->values()->toArray();

        session(['cart' => $items]);
    }


    public function update($id, $qty)
    {
        $items = $this->cart->map(function ($row) use ($id, $qty) {
            if ($row['id'] == $id) {
                return ['id' => $row['id'], 'qty' => $qty];
            }
            return $row;
        })->toArray();

        session(['cart' => $items]);
    }

}
