<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->create([
            'first_name' => 'Ana',
            'last_name' => 'Perez',
            'email'  => 'anaperez@email.com',
            'phone'  => '123456789',
            'address'  => 'Calle Falsa 123',
            'rut'  => '12345678-9',
            'customer_type_id'  => 1,
        ]);

        Customer::factory(10)->create();
    }
}
