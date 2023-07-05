<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->sequence(['is_admin' => true], ['is_admin' => false])->create();

        User::factory()->create([
            'username' => 'kodingrick',
            'email' => 'kodingrick@gmail.com',
            'is_admin' => true,
        ]);
    }
}
