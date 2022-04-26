<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Kecelakaan',
            'slug' => 'kecelakaan',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Category::create([
            'name' => 'Olahraga',
            'slug' => 'olahraga',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
