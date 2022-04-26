<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'hanif',
                'email' => 'hanif@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o1Zqj02150sARmrYMnzF8u0hgi8DRdWbBKLeaPaGEqa1GcjoW97wu',
                'level' => 'user',
                'username' => 'Hanif',
                'no_hp' => '089657512755',
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Indra',
                'email' => 'indra@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o1Zqj02150sARmrYMnzF8u0hgi8DRdWbBKLeaPaGEqa1GcjoW97wu',
                'level' => 'user',
                'username' => 'indra123',
                'no_hp' => '089657512733',
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin',
                'email' => 'adminnews@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o1Zqj02150sARmrYMnzF8u0hgi8DRdWbBKLeaPaGEqa1GcjoW97wu',
                'level' => 'superadmin',
                'username' => 'super_admin',
                'no_hp' => '08941712318',
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'dzikri',
                'email' => 'dzikri@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o1Zqj02150sARmrYMnzF8u0hgi8DRdWbBKLeaPaGEqa1GcjoW97wu',
                'level' => 'kontributor',
                'username' => 'dzikri',
                'no_hp' => '08954723834',
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'zaki',
                'email' => 'zaki@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$o1Zqj02150sARmrYMnzF8u0hgi8DRdWbBKLeaPaGEqa1GcjoW97wu',
                'level' => 'editor',
                'username' => 'zaki',
                'no_hp' => '08954723822',
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ),
        ));
    }
}
