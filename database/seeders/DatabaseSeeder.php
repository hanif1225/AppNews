<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(ProfilSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(KontakSeeder::class);
        $this->call(NominalSeeder::class);
    }
}