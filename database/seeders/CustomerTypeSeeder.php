<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerType::factory()->create([
            'name' => 'habitual',
            'description' => 'Cliente habitual',
            'discount_percentage' => 10,
        ]);

        CustomerType::factory()->create([
            'name' => 'esporádico',
            'description' => 'Cliente esporádico',
        ]);
    }
}
