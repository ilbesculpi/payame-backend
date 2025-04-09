<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Associate;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> bcrypt('demo1234'),
        ]);
        User::factory()->create([
            'name' => 'System User',
            'email' => 'system@example.com',
            'password'=> bcrypt('demo1234'),
        ]);

        Customer::factory()->create([
            'user_id' => 2,
            'full_name'=> 'Francisco Rojas',
            'email'=> '',
            'telephone' => '04246610080',
            'company' => '',
            'address' => 'Calle 1, Casa 2',
            'notes' => '',
        ]);

        Associate::factory()->create([
            'user_id' => 2,
            'full_name'=> 'Indira Marcano',
        ]);

        Associate::factory()->create([
            'user_id' => 2,
            'full_name'=> 'Jose Luis Moreno',
        ]);
    }
}
