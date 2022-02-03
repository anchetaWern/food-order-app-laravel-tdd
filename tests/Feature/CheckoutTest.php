<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Order;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cart_items_can_be_seen_from_the_checkout_page()
    {
        $this->withoutExceptionHandling();
        Product::factory()->create([
            'name' => 'Taco',
            'cost' => 1.5,
        ]);
        Product::factory()->create([
            'name' => 'Pizza',
            'cost' => 2.1,
        ]);
        Product::factory()->create([
            'name' => 'BBQ',
            'cost' => 3.2,
        ]);


        session(['cart' => [
            ['id' => 2, 'qty' => 1], // Pizza
            ['id' => 3, 'qty' => 2], // BBQ
        ]]);

        $checkout_items = [
            [
                'id' => 2,
                'qty' => 1,
                'name' => 'Pizza',
                'cost' => 2.1,
                'subtotal' => 2.1,
            ],
            [
                'id' => 3,
                'qty' => 2,
                'name' => 'BBQ',
                'cost' => 3.2,
                'subtotal' => 6.4,
            ],
        ];

        $this->get('/checkout')
            ->assertViewIs('checkout')
            ->assertViewHas('checkout_items', $checkout_items)

            ->assertSeeTextInOrder([
                // Item #1
                'Pizza',
                '$2.1',
                '1x',
                '$2.1',

                // Item #2
                'BBQ',
                '$3.2',
                '2x',
                '$6.4',

                '$8.5', // total
            ]);
    }


    /** @test */
    public function order_can_be_created()
    {
        Product::factory()->create([
            'name' => 'Taco',
            'cost' => 1.5,
        ]);
        Product::factory()->create([
            'name' => 'Pizza',
            'cost' => 2.1,
        ]);
        Product::factory()->create([
            'name' => 'BBQ',
            'cost' => 3.2,
        ]);

        // add items to cart
        $this->post('/cart', [
            'id' => 1, // Taco
        ]);
        $this->post('/cart', [
            'id' => 2, // Pizza
        ]);
        $this->post('/cart', [
            'id' => 3, // BBQ
        ]);

        // update qty of taco to 5
        $this->patch('/cart/1', [
            'qty' => 5,
        ]);

        // remove pizza
        $this->delete('/cart/2');

        $this->post('/checkout')
            ->assertSessionHasNoErrors()
            ->assertRedirect('/summary');

        $this->assertDatabaseHas('orders', [
            'total' => 10.7,
        ]);

        $this->assertDatabaseHas('order_details', [
            'order_id' => 1,
            'product_id' => 1,
            'cost' => 1.5,
            'qty' => 5,
        ]);

        $this->assertDatabaseHas('order_details', [
            'order_id' => 1,
            'product_id' => 3,
            'cost' => 3.2,
            'qty' => 1,
        ]);
    }
}
