<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profil_user;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Afiliasi;
use App\Models\Permintaan;
use File;

class ProfilRestController extends Controller
{
    //aksi
    
    public function index()
    {
        $profil = auth()->user()->profil;
        $user = auth()->user();
 
        return response()->json([
            'success' => true,
            'data'    => $profil,
            'data_user' => $user,
        ]);
    }
    
    public function store(Request $request)
    {
        //Mengambil gambar foto dan ktp
        $foto = $request->foto;
        $nama_foto = $request->nama_foto;
        $file = base64_decode($foto);
        file_put_contents("foto/".$nama_foto,$file);
        
        $ktp = $request->ktp;
        $nama_ktp = $request->nama_ktp;
        $file2 = base64_decode($ktp);
        file_put_contents("u_ktp/".$nama_ktp,$file2);

        $user_id = auth()->user()->id;
 
        $profil = new Profil_user();
        $profil->user_id        = $user_id;
        $profil->alamat         = $request->alamat;
        $profil->tanggal_lahir  = $request->tanggal_lahir;
        $profil->jenis_kelamin  = $request->jenis_kelamin;
        $profil->nama_rekening  = $request->nama_rekening;
        $profil->no_rekening    = $request->no_rekening;
        $profil->instagram      = $request->instagram;
        $profil->foto           = $nama_foto;
        $profil->ktp            = $nama_ktp;
        $profil->status         = "Pending";

                //membuat kode afiliasi
                function random($length)
                {
                    $data = 'ABCDEFGHIJKLMNOPQRSTUPWXYZabcdefghijklmnopqrstupwxyz1234567890';
                    $string = '';
                    for($i = 0; $i < $length; $i++) {
                        $pos = rand(0, strlen($data)-1);
                        $string .= $data{$pos};
                    }
                    return $string;
                } 
                $output_random = random(10);
        
                Afiliasi::create(
                    [
                        'user_id'       => $user_id,
                        'kode_afiliasi' => $output_random,
                    ]);
 
        if (auth()->user()->posts()->save($profil))
            return response()->json([
                'success' => true,
                'data' => $profil->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan'
            ], 500);
    }
    //end aksi

    public function edit($id)
    {

        $user = User::find($id);
        $profil = Profil_user::where('id',$user->profil->id)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Di temukan'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data_user' => $user->toArray(),
            'data_profil' => $profil->toArray(),
        ], 400); 
    }

    public function update(Request $request, $id)
    {

        $profil = Profil_user::find($id);
        $user = auth()->user()->find($profil->user_id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 400);
        }

        //cek jika ada password
        if($request->password != '')
        {

                $request->validate([
                    'password' => 'min:8',
                ],
                [
                    'password.min' => 'Password Minimal 8 Karakter',
                ]);
                $data_utama= array(
                    'password' => Hash::make($request->password),
                );
                User::whereId($profil->user_id)->update($data_utama);
        }


                //update data utama
       
        //untuk validasi
        
        //mengecek apakah datanya sama atau tidak, jika sama maka tidak di update
        if(auth()->user()->email == $request->email && auth()->user()->username == $request->username && auth()->user()->no_hp == $request->no_hp)
        {
            $request->validate([
                'name' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
            ]);
            $data_utama= array(
                'name'    =>  $request->name,
            );
            User::whereId($profil->user_id)->update($data_utama);
        }

        if(auth()->user()->email != $request->email)
        {
            $request->validate([
                'email' => 'unique:users',

            ],
            [
                'email.unique' => 'Email Sudah Di Gunakan, Silahkan Gunakan Email Lain',
            ]);
            $data_utama= array(
                'email'       =>  $request->email,
                'name'    =>  $request->name,
            );
            User::whereId($profil->user_id)->update($data_utama);
        }

        if(auth()->user()->username != $request->username)
        {
            $request->validate([
                'username' => 'required|unique:users',
                'name'     => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'username.required' => 'Username Wajib di Isi',
                'username.unique' => 'Username Sudah Di Gunakan, Silahkan Gunakan Username Lain',
            ]);

            $data_utama = array(
                'username'       =>  $request->username,
                'name'    =>  $request->name,
            );
            User::whereId($profil->user_id)->update($data_utama);
        }

        if(auth()->user()->no_hp != $request->no_hp)
        {
            $request->validate([
                'no_hp' => 'required|unique:users',
                'name' => 'required',
            ],
            [
                'no_hp.required' => 'No HP Wajib di Isi',
                'name.required' => 'Nama Wajib di Isi',
                'no_hp.unique' => 'No HP Sudah Di Gunakan, Silahkan Gunakan No HP Lain',
            ]);

            $data_utama= array(
                'no_hp'   =>  $request->no_hp,
                'name'    =>  $request->name,
            );
            User::whereId($profil->user_id)->update($data_utama);
        }

        //edit data profile

        $old_image_name = $request->old_image_name ;
        $new_image_name = $request->new_image_name ;
        $foto           = $request->foto ;

        $old_image_ktp  = $request->old_image_ktp;
        $new_image_ktp  = $request->new_image_ktp;
        $ktp            = $request->ktp;
        

        // dd($old_image_name);
        //validasi untuk gambar foto dan ktp
        if($foto != '' && $ktp != '')
        {


            $request->validate([
                'name' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'instagram' => 'required',
                'foto' => 'require', 
                'ktp' => 'required', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'foto.required' => 'Foto wajib di isi!',
                'ktp.required' => 'KTP wajib di isi!',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $file  = base64_decode($foto);
            $file2 = base64_decode($ktp);

            $image_name=$new_image_name;
            unlink("foto/".$old_image_name);
             file_put_contents("foto/".$image_name,$file);

            $image_name_ktp=$new_image_ktp;
            unlink("u_ktp/".$old_image_ktp);
             file_put_contents("u_ktp/".$image_name_ktp,$file2);
        }
        elseif($foto != '' && $ktp == '')
        {
            $file  = base64_decode($foto);

            $request->validate([
                'name' => 'required',
                'instagram' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'foto' => 'required', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'foto.required' => 'Foto wajib di isi!',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $image_name_ktp=$old_image_ktp;
            $image_name=$new_image_name;
            unlink("foto/".$old_image_name);
            file_put_contents("foto/".$image_name,$file);
        }
        elseif($foto == '' && $ktp != '')
        {
            $file2 = base64_decode($ktp);

            $request->validate([
                'name' => 'required',
                'instagram' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'ktp' => 'required', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'ktp.required' => 'KTP wajib di isi!',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $image_name=$old_image_name;
            $image_name_ktp=$new_image_ktp;
            unlink("u_ktp/".$old_image_ktp);
            file_put_contents("u_ktp/".$image_name_ktp,$file2);
        }
        else 
        {
            $request->validate([
                'name' => 'required',
                'instagram' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',
            ]);
            $image_name=$old_image_name;
            $image_name_ktp=$old_image_ktp;
        }

        $data_profil= array(
            'alamat'       =>  $request->alamat,
            'instagram'    =>  $request->instagram,
            'tanggal_lahir'=>  $request->tanggal_lahir,
            'jenis_kelamin'=>  $request->jenis_kelamin,   
            'nama_rekening'=>  $request->nama_rekening,
            'no_rekening'  =>  $request->no_rekening,
            'foto'         =>  $image_name,
            'ktp'          =>  $image_name_ktp,
        );
        //end validasi untuk gambar foto dan ktp
        
        $update= Profil_user::find($id)->update($data_profil);
        
        if($update){
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di update'
            ], 200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'data gagal di update'
            ], 400);
        }

    }

    public function pendaftaran(Request $request, $id)
    {

        $profil = auth()->user()->profil()->find($id);

        $permintaan = Permintaan::where('user_id', $profil->user_id)->first();
 
        //Melakukan Pengecekan untuk profil
        if (!$profil) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 400);
        }

        // Melakukan pengecekan untuk permintaan
        if($permintaan != '')
        {   
            //melakukan pengecekan data jika datanya sama
            if($permintaan->kode_akses == $request->kode_akses && $permintaan->permintaan == $request->permintaan)
            {
                $data_user= array(
                    'level'       =>  $request->permintaan,
                );
                $data_permintaan = array(
                    'status'      => 'aktif',
                );
                    //untuk menampilkan pesan
                    if($request->permintaan == 'kontributor')
                    {
                    $message = "Selamat Anda Telah Menjadi Kontributor";
                    }
                    elseif($request->permintaan == 'editor')
                    {
                        $message = "Selamat Anda Telah Menjadi Editor";
                    }

                $update = User::find($profil->user_id)->update($data_user);
                Permintaan::where('user_id', $profil->user_id)->update($data_permintaan);
                
                //menampilkan data berhasil menjadi kontributor/editor
                if($update){
                    return response()->json([
                        'success' => true,
                        'message' => $message,
                    ], 200);
                }
            }
            // menampilkan pesan jika kode akses tidak sesuai
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode Akses Tidak Sesuai'
                ], 400);
            }
        }
        // menampilkan pesan user tidak direkomendasikan oleh admin
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Direkomendasikan Oleh Admin'
            ], 400);
        }
    }

}
