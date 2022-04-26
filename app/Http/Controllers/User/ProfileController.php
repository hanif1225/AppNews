<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Afiliasi;
use File;

class ProfileController extends Controller
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
        
        $profil = new Profil_user;
        if(auth()->user()->level == 'user'){
            return view('user.profile.index', [
                'user' => user::with('profil')->find(auth()->user()->id),
            ]);
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $user_id = auth()->user()->id;
         Profil_user::create(
        [
            'user_id' => $user_id,
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
        
        return redirect('profile')->with('pesan', 'Data Profile Berhasil Di Simpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('user.profile.edit',compact('profil','user'));    
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
        return redirect('/profile')->with('pesan', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
