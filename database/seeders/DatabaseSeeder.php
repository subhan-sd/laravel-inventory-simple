<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        // Seed Products
        DB::table('products')->insert([
            ['name' => 'iPhone 13', 'description' => 'Apple smartphone with A15 Bionic chip', 'price' => 12999000.00, 'stock' => 10, 'category' => 'Smartphone', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Samsung Galaxy S21', 'description' => 'Flagship Samsung smartphone', 'price' => 11999000.00, 'stock' => 8, 'category' => 'Smartphone', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Xiaomi Redmi Note 12', 'description' => 'Affordable smartphone with great specs', 'price' => 3499000.00, 'stock' => 15, 'category' => 'Smartphone', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MacBook Air M1', 'description' => 'Lightweight laptop with Apple M1 chip', 'price' => 14999000.00, 'stock' => 5, 'category' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ASUS ROG Strix', 'description' => 'Gaming laptop high performance', 'price' => 19999000.00, 'stock' => 3, 'category' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lenovo ThinkPad X1', 'description' => 'Business laptop durable and fast', 'price' => 17999000.00, 'stock' => 6, 'category' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wireless Mouse Logitech', 'description' => 'Ergonomic wireless mouse', 'price' => 250000.00, 'stock' => 20, 'category' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mechanical Keyboard RGB', 'description' => 'Gaming keyboard with RGB lighting', 'price' => 750000.00, 'stock' => 12, 'category' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'USB-C Hub 7 in 1', 'description' => 'Multiport adapter for laptops', 'price' => 450000.00, 'stock' => 18, 'category' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'External SSD 1TB', 'description' => 'Fast portable storage', 'price' => 1650000.00, 'stock' => 9, 'category' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sony WH-1000XM4', 'description' => 'Noise cancelling headphones', 'price' => 3999000.00, 'stock' => 7, 'category' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'JBL Flip 6', 'description' => 'Portable Bluetooth speaker', 'price' => 1799000.00, 'stock' => 14, 'category' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AirPods Pro', 'description' => 'Apple wireless earbuds', 'price' => 3499000.00, 'stock' => 11, 'category' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soundbar Samsung', 'description' => 'Home theater soundbar', 'price' => 2599000.00, 'stock' => 4, 'category' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Microphone Condenser', 'description' => 'Studio recording microphone', 'price' => 899000.00, 'stock' => 10, 'category' => 'Audio', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Customers
        DB::table('customers')->insert([
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567890', 'address' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Siti Rahma', 'email' => 'siti@example.com', 'phone' => '082345678901', 'address' => 'Bandung', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Andi Wijaya', 'email' => 'andi@example.com', 'phone' => '083456789012', 'address' => 'Surabaya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
