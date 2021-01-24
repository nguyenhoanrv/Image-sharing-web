<?php

use Illuminate\Database\Seeder;
use App\Category;  
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Nature']);
        Category::create(['name' => 'Wildlife']);
        Category::create(['name' => 'People']);
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Animals']);
        Category::create(['name' => 'Underwater']);
        Category::create(['name' => 'Night']);
        Category::create(['name' => 'Creative']);

    }
}