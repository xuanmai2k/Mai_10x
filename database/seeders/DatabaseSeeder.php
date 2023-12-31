<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create(['phone'=> "0123456789",'dob'=>'1985-03-02']); //password

        \App\Models\User::factory(3)->create(['role'=> 1, 'phone'=> "0123456789", 'dob'=>'1985-03-02']);

        \App\Models\ProductCategory::factory(10)->create();

        \App\Models\Product::factory(100)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
