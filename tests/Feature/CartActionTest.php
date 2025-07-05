<?php

namespace Tests\Feature;

use App\Actions\CartAction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartActionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::where('email', 'noob1@gmail.com')->firstOrFail();

        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        // add product to cart senario 
        $user = auth()->user();

        $cheese = Product::where('name', 'Cheese')->firstOrFail();
        $tv = Product::where('name', 'TV')->firstOrFail();
        $scratchCard = Product::where('name', 'Mobile Scratch Card')->firstOrFail();

        $cheese_added = CartAction::addProduct($user, $cheese);
        if (!$cheese_added)
            throw new \Exception("No Cheese.");
        $tv_added = CartAction::addProduct($user, $tv);

        if (!$tv_added)
            throw new \Exception("No tv.");

        $scratchCard_added = CartAction::addProduct($user, $scratchCard);

        if (!$scratchCard_added)
            throw new \Exception("No Scratch Card.");
    }

}
