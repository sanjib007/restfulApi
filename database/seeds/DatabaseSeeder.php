<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        \App\User::truncate();
        \App\Category::truncate();
        \App\Product::truncate();
        \App\Transaction::truncate();
        DB::table('category_product')->truncate();

        \App\User::flushEventListeners();
        \App\Category::flushEventListeners();
        \App\Product::flushEventListeners();
        \App\Transaction::flushEventListeners();


        $usersQuentity = 1000;
        $categoriesQuentity = 30;
        $productsQuentity = 1000;
        $transactionsQuentity = 1000;

        factory(\App\User::class, $usersQuentity)->create();
        factory(\App\Category::class, $categoriesQuentity)->create();
        factory(\App\Product::class, $productsQuentity)->create()->each(
            function ($product){
                $categories = \App\Category::all()->random(mt_rand(1, 5))->pluck('id');

                $product->categories()->attach($categories);
            }
        );
        factory(\App\Transaction::class, $transactionsQuentity)->create();

    }
}
