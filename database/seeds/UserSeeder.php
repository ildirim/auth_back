<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'full_name' => 'Admin admin',
		        'email' => 'admin@admin.com',
		        'email_verified_at' => now(),
		        'password' => '$2y$10$8bbaTR04bwCpNcTN//9kU.wL3UAsYdYxwSY.41pPeCYQN5v1HR12O', // password
		        'is_admin' => 1
            ]);
    }
}
