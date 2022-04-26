<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Profil_user;
use App\Models\User;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Profil_user::create([
                'user_id' => 1,
                'foto' => 'user.png',
                'alamat' => 'Pataruman RT 01 RW 12, Desa Pataruman, Kecamatan Tarogong Kidul, Garut',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'Laki-Laki',
                'instagram' => 'hanif122',
                'ktp' => 'ktp.png',
                'nama_rekening' => 'BRI',
                'no_rekening' => '083249234723938423',
                'status' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Profil_user::create([
                'user_id' => 2,
                'foto' => 'user2.png',
                'alamat' => 'Leles, Desa Pataruman, Kecamatan Tarogong Kidul, Garut',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'Laki-Laki',
                'instagram' => 'indrat',
                'ktp' => 'ktp2.png',
                'nama_rekening' => 'BNI',
                'no_rekening' => '2323477832499234',
                'status' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Profil_user::create([
                'user_id' => 3,
                'foto' => 'admin.png',
                'alamat' => ' ',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'Laki-Laki',
                'instagram' => 'admin',
                'ktp' => 'admin.png',
                'nama_rekening' => 'BNI',
                'no_rekening' => '2323477832499234',
                'status' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
