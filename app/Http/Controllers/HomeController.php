<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Pengajuan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->level=="superadmin")
        {
            return view('dashboard',[
                'jumlah_user'                => User::where('level','user')->count(),
                'jumlah_kontributor'         => User::where('level','kontributor')->count(),
                'jumlah_editor'              => User::where('level','editor')->count(),
                'jumlah_postingan'           => Postingan::where('status','aktif')->count(),
                'jumlah_pending'             => Postingan::where('status','pending')->count(),
                'jumlah_draft'               => Postingan::where('status','draft')->count(),
                'jumlah_editing'             => Postingan::where('status','editing')->count(),
                'jumlah_tolak'               => Postingan::where('status','ditolak')->count(),
                'jumlah_pengajuan'           => Pengajuan::where('status','pending')->count(),
                'jumlah_pengajuan_success'   => Pengajuan::where('status','diterima')->count(),
            ]);
        }
        elseif(auth()->user()->level=="user")
        {
            $id = auth()->user()->id;
            return view('dashboard_user',[
                'jumlah_postingan'   => Postingan::where('status','aktif')->where('user_id',$id)->count(),
                'jumlah_pending'     => Postingan::where('status','pending')->where('user_id',$id)->count(),
                'jumlah_tolak'       => Postingan::where('status','ditolak')->where('user_id',$id)->count(),
            ]);
        }
        elseif(auth()->user()->level=="kontributor")
        {
            $id = auth()->user()->id;
            return view('dashboard_kontributor',[
                'jumlah_postingan'   => Postingan::where('status','aktif')->where('user_id',$id)->count(),
                'jumlah_pending'     => Postingan::where('status','pending')->where('user_id',$id)->count(),
                'jumlah_tolak'       => Postingan::where('status','ditolak')->where('user_id',$id)->count(),
            ]);
        }
        elseif(auth()->user()->level=="editor")
        {
            return view('dashboard_editor',[
                'jumlah_postingan'   => Postingan::where('status','aktif')->count(),
                'jumlah_pending'     => Postingan::where('status','pending')->count(),
                'jumlah_tolak'       => Postingan::where('status','ditolak')->count(),
            ]);
        }
    }
}
