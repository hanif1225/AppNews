<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kontak;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kontak::create([
            'wa' => '+6282320777692',
            'email' => 'cs@infogarut.id',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
