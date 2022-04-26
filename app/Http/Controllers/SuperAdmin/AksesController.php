<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Permintaan;

class AksesController extends Controller
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
        $output_random = random(10) ;

        $no = 0;
        return view('superadmin.hak_akses.index', [
            "data_permintaan" => Permintaan::with(['user'])
                                ->latest()->filter(request(['search']))
                                ->paginate(20)->withQueryString(),
            "no"              => $no,
            "data_pengguna"   => User::where('level', 'user')->get(),
            "output_random"   => $output_random,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required',
            'kode_akses' => 'required',
            'permintaan' => 'required',
        ],
        [
            'user_id.required'     => 'ID Wajib di Isi',
            'kode_akses.required' => 'Kode Akses Wajib di Isi',
            'permintaan.required' => 'Permintaan Wajib di Isi',
        ]);

        Permintaan::create(
            [
                'user_id'       => $request->user_id,
                'kode_akses'    => $request->kode_akses,
                'permintaan'    => $request->permintaan,
                'status'        => 'belum aktif',
            ]);

            return redirect('akses')->with('pesan', 'Data Berhasil Di Simpan');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_akses   = Permintaan::find($id);

        $data_akses->delete();
        return redirect('akses')->with('pesan', 'Data berhasil di hapus');
    }
}
