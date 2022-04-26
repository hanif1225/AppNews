<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profil_user;
use File;

class DatapenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $no = 0;
        return view('superadmin.data_pengguna.index', [
            "data_pengguna" => User::with(['profil'])
            ->latest()->filter(request(['search']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.data_pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->password != $request->cpassword)
        {
            \Session::flash('error','Password Tidak Sama!');
            return redirect()->back()->with('error','Password Tidak Sama!');
        }    
        $request->validate([
            'name' => 'required|min:4',
            'username' => 'required|unique:users|min:4',
            'email' => 'required|unique:users|email',
            'no_hp' => 'required|unique:users',
            'password' => 'required|min:8',
        ],
        [
            'name.required'        => 'Nama Wajib di Isi',
            'username.required'    => 'Username Wajib di Isi',
            'email.required'       => 'Email Wajib di Isi',
            'no_hp.required'       => 'No HP Wajib di Isi',
            'password.required'    => 'Password Wajib di Isi',
            'name.min'             => 'Minimal 4 kata',
            'username.min'         => 'Minimal 4 kata',
            'password.min'         => 'Minimal 4 kata',
        ]);

        User::create(
            [
                'name'       => $request->name,
                'username'   => $request->username,
                'email'      => $request->email,
                'no_hp'      => $request->no_hp,
                'password'   => Hash::make($request->password),
                'level'   => $request->level,
            ]);

            return redirect('datapengguna')->with('pesan', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =User::with('profil')->find($id);
        return view('superadmin.data_pengguna.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profil = Profil_user::find($id);
        $user  = User::where('id',$profil->user_id)->first();

        return view('superadmin.data_pengguna.edit',compact('profil','user'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profil = Profil_user::find($id);
        //cek jika ada password
        if($request->password != '')
        {
            if($request->password != $request->cpassword){
                \Session::flash('error','Password Tidak Sama!');
                return redirect()->back()->with('error','Password Tidak Sama!');
            }    
            else
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
        }
        //update data utama
       
        //untuk validasi
        
        //mengecek apakah datanya sama atau tidak, jika sama maka tidak di update
        if($request->email2 == $request->email && $request->username2 == $request->username && $request->no_hp2 == $request->no_hp)
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

        if($request->email2 != $request->email)
        {
            $request->validate([
                'email' => 'required|unique:users',
                'name' => 'required',
            ],
            [
                'email.required' => 'Email Wajib di Isi',
                'name.required' => 'Nama Wajib di Isi',
                'email.unique' => 'Email Sudah Di Gunakan, Silahkan Gunakan Email Lain',
            ]);
            $data_utama= array(
                'email'       =>  $request->email,
                'name'    =>  $request->name,
            );
            User::whereId($profil->user_id)->update($data_utama);
        }

        if($request->username2 != $request->username)
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

        if($request->no_hp2 != $request->no_hp)
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

        $old_image_name = $request->hidden_image;
        $image          = $request->file('gambar');

        $old_image_ktp = $request->hidden_ktp;
        $image_ktp     = $request->file('gambar_ktp');

        // dd($old_image_name);
        //validasi untuk gambar foto dan ktp
        if($image != '' && $image_ktp != '')
        {
            $request->validate([
                'name' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'instagram' => 'required',
                'gambar' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
                'gambar_ktp' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'gambar.mimes' => 'Foto wajib berformat PNG, JPG, JPEG dan SVG!', 
                'gambar.required' => 'Foto wajib di isi!',
                'gambar.max' => 'Maksimal ukuran foto 2,5 MB',
                'gambar_ktp.max' => 'Maksimal ukuran ktp 2,5 MB',
                'gambar_ktp.mimes' => 'KTP wajib berformat PNG, JPG, JPEG dan SVG!', 
                'gambar_ktp.required' => 'KTP wajib di isi!',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $image_name=$old_image_name;
            $image->move(public_path('foto'),$image_name);

            $image_name_ktp=$old_image_ktp;
            $image_ktp->move(public_path('u_ktp'),$image_name_ktp);
        }
        elseif($image != '' && $image_ktp == '')
        {
            $request->validate([
                'name' => 'required',
                'instagram' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'gambar' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'gambar.mimes' => 'Foto wajib berformat PNG, JPG, JPEG dan SVG!', 
                'gambar.required' => 'Foto wajib di isi!',
                'gambar.max' => 'Maksimal ukuran foto 2,5 MB',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $image_name_ktp=$old_image_ktp;
            $image_name=$old_image_name;
            $image->move(public_path('foto'),$image_name);
        }
        elseif($image == '' && $image_ktp != '')
        {
            $request->validate([
                'name' => 'required',
                'instagram' => 'required',
                'alamat' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'gambar_ktp' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
                'nama_rekening' => 'required',
                'no_rekening' => 'required',
            ],
            [
                'name.required' => 'Nama Wajib di Isi',
                'instagram.required' => 'Instagram Wajib di Isi',
                'alamat.required' => 'Alamat Wajib di Isi',
                'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
                'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
                'gambar_ktp.max' => 'Maksimal ukuran ktp 2,5 MB',
                'gambar_ktp.mimes' => 'KTP wajib berformat PNG, JPG, JPEG dan SVG!', 
                'gambar_ktp.required' => 'KTP wajib di isi!',
                'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
                'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

            ]);
            $image_name=$old_image_name;
            $image_name_ktp = $old_image_ktp;
            $image_ktp->move(public_path('u_ktp'), $image_name_ktp);
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
        
        Profil_user::find($id)->update($data_profil);
        return redirect('datapengguna')->with('pesan', 'Berhasil edit data pengguna');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_user   = User::find($id);
        $data_user->delete();
        return redirect('datapengguna')->with('pesan', 'Data berhasil di hapus');
    }

    public function destroy_profil($id)
    {
        $data_profil = Profil_user::find($id);
        $data_user   = User::find($data_profil->user_id);

        File::delete('foto/'.$data_profil->foto);
        File::delete('u_ktp/'.$data_profil->ktp);
        $data_profil->delete();
        $data_user->delete();
        return redirect('datapengguna')->with('pesan', 'Data berhasil di hapus');
    }

    public function create_profil($id)
    {
        $user  = User::where('id',$id)->first();
        return view('superadmin.data_pengguna.create_profil',compact('user'));
    }

    public function store_profil(Request $request, $id)
    {
        $request->validate([
          
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
            'ktp' => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
        ],
        [
            'alamat.required' => 'Alamat Wajib di Isi',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi',
            'foto.mimes' => 'Foto wajib berformat PNG, JPG, JPEG dan SVG!', 
            'foto.required' => 'Foto wajib di isi!',
            'foto.max' => 'Maksimal ukuran foto 2,5 MB',
            'ktp.max' => 'Maksimal ukuran ktp 2,5 MB',
            'ktp.mimes' => 'KTP wajib berformat PNG, JPG, JPEG dan SVG!', 
            'ktp.required' => 'KTP wajib di isi!',
            'nama_rekening.required' => 'Nama Bank Rekening Wajib di Isi',
            'no_rekening.required' => 'Nomor Rekening Wajib di Isi',

        ]);

        $file = $request->file('foto');
        $namafile = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('foto'), $namafile);

        $file2 = $request->file('ktp');
        $namafile2 = time().'.'.$file2->getClientOriginalExtension();
        $file2->move(public_path('u_ktp'), $namafile2);

         Profil_user::create(
        [
            'user_id' => $id,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_rekening' => $request->nama_rekening,
            'no_rekening' => $request->no_rekening,
            'instagram' => $request->instagram,
            'foto' => $namafile,
            'ktp' => $namafile2,
            'status' => "pending",
        ]);
        
        return redirect('datapengguna')->with('pesan', 'Data Profile Berhasil Dilengkapi ');
    }
}
