<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profil_user;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Permintaan;
use App\Models\Statistik;
use File;


class StatistikrestController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $tanggal        = date("Y-m-d");

        $data = \DB::table('statistik')
                ->select([
                    \DB::raw('count(*) as jumlah'),
                    \DB::raw('Date(tanggal) as tanggal')
                ])
                ->groupBy('tanggal')
                ->where('user_id',$id)
                ->orderBy('tanggal','desc')
                ->get()->toArray();

                
        $data2 = \DB::table('statistik')
                ->select([
                    \DB::raw('count(*) as jumlah'),
                    \DB::raw('Date(tanggal) as tanggal')
                ])
                ->groupBy('tanggal')
                ->where('user_id',$id)
                ->whereRaw('DATE(tanggal) >= ?',[date('Y-m-d',strtotime('-7 days'))])
                ->orderBy('tanggal','desc')
                ->get()->toArray();

        $data_iklan = \DB::table('statistik')
                ->select([
                    \DB::raw('count(*) as jumlah'),
                    \DB::raw('judul as judul'),
                    \DB::raw('postingan_id as postingan_id'),
                   
                ])
                ->groupBy('judul','postingan_id')
                ->where('user_id',$id)
                ->where('status_iklan','aktif')
                ->limit(5)
                ->orderBy('judul','desc')
                ->get()->toArray();

        
        $hari_ini = Statistik::where('tanggal',$tanggal)->where('user_id',$id)->count();
        if ($data != ' ') {
            return response()->json([
                'success'          => true,
                 'data'            => $data,
                 'data2'            => $data2,
                 'hari_ini'        => $hari_ini,
                 'data_iklan'      => $data_iklan,
            ]);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'tidak ada data'
                ], 400);
            }

    }
}
