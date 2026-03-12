<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@kantinku.com',
        ]);

        $vendor1 = User::factory()->vendor()->create([
            'name' => 'Vendor',
            'email' => 'vendor@kantinku.com',
        ]);

        $vendor2 = User::factory()->vendor()->create([
            'name' => 'Vendor2',
            'email' => 'vendor2@kantinku.com',
        ]);

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@kantinku.com',
        ]);

        // Create wallets for admin, vendors, and user
        Wallet::create([
            'user_id' => $admin->id,
            'balance' => 0,
        ]);

        Wallet::create([
            'user_id' => $vendor1->id,
            'balance' => 0,
        ]);

        Wallet::create([
            'user_id' => $vendor2->id,
            'balance' => 0,
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 1000000,
        ]);

        Product::factory()
            ->count(1)
            ->for($vendor1, 'vendor')
            ->create();

        Product::factory()
            ->count(1)
            ->for($vendor2, 'vendor')
            ->create();

        // Create Regular Users with Wallets
        // User::factory(10)->create()->each(function ($user) {
        //     if (!$user->wallet) {
        //         \App\Models\Wallet::create([
        //             'user_id' => $user->id,
        //             'balance' => 500000,
        //         ]);
        //     } else {
        //         $user->wallet->update(['balance' => 500000]);
        //     }
        // });

        // Create Vendors with Products
        // User::factory(5)->vendor()->create()->each(function ($vendor) {
        //     if (!$vendor->wallet) {
        //         \App\Models\Wallet::create([
        //             'user_id' => $vendor->id,
        //             'balance' => 1000000,
        //         ]);
        //     } else {
        //         $vendor->wallet->update(['balance' => 1000000]);
        //     }

        // Create 5-10 products per vendor
        //     Product::factory()
        //         ->count(rand(5, 10))
        //         ->for($vendor, 'vendor')
        //         ->create();
        // });

        // Create Orders with Order Details
        // User::where('role', 'user')->get()->each(function ($user) {
        //     Order::factory(2)
        //         ->for($user)
        //         ->create()
        //         ->each(function ($order) {
        //             // Add 2-5 products per order
        //             $products = Product::where('status', 'available')
        //                 ->inRandomOrder()
        //                 ->limit(rand(2, 5))
        //                 ->get();

        //             $totalAmount = 0;
        //             $products->each(function ($product) use ($order, &$totalAmount) {
        //                 $quantity = rand(1, 3);
        //                 $subtotal = $product->price * $quantity;

        //                 OrderDetail::create([
        //                     'order_id' => $order->id,
        //                     'product_id' => $product->id,
        //                     'quantity' => $quantity,
        //                     'price' => $product->price,
        //                     'subtotal' => $subtotal,
        //                 ]);

        //                 $totalAmount += $subtotal;
        //             });

        //             // Update order total
        //             $order->update(['total_amount' => $totalAmount]);
        //         });
        // });
    }
}
