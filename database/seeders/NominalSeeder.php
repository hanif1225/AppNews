<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nominal;

class NominalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nominal::create([
            'harga' => '2000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
