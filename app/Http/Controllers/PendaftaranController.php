<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Permintaan;

class PendaftaranController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user  = User::where('id',$id)->first();
   
         return view('user.profile.pendaftaran',compact('user'));
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
        $profil = Profil_user::where('user_id',$id)->first();
        $permintaan = Permintaan::where('user_id', $id)->first();

        if($permintaan != '')
        {   
            if($permintaan->kode_akses == $request->kode_akses && $permintaan->permintaan == $request->permintaan)
            {
                $data_user= array(
                    'level'       =>  $request->permintaan,
                );
                $data_permintaan = array(
                    'status'      => 'aktif',
                );
                User::find($id)->update($data_user);
                Permintaan::where('user_id', $id)->update($data_permintaan);
                if($request->permintaan == 'kontributor')
                {
                    return redirect('/kontributor/profile')->with('pesan', 'Pengajuan Berhasil');
                }
                elseif($request->permintaan == 'editor')
                {
                    return redirect('/editor/profile')->with('pesan', 'Pengajuan Berhasil');
                }
                
            }
            else
            {
                return redirect('/profile')->with('error', 'Kode akses tidak sesuai');
            }
        }
        else
        {
            return redirect('/profile')->with('error', 'User tidak direkomendasikan oleh admin');
        }
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
