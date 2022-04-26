<?php

namespace App\Http\Controllers\Umum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;

class KomentarumumrestController extends Controller
{
    public function isi()
    {
        $id = auth()->user()->id;
        if($id)
        {
            return response()->json([
                'success' => true,
                'data' => $id,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah Komentar Tidak Ditemukan'
            ], 400);
        }
    }
    public function show($id)
    {
        $data_komentar = Komentar::where('postingan_id',$id)->where('status','aktif')->count();
        if($data_komentar)
        return response()->json([
            'success' => true,
            'data' => $data_komentar,
        ]);
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah Komentar Tidak Ditemukan'
            ], 400);
        }
    }

    public function detail($id)
    {
        $data_komentar = Komentar::where('postingan_id',$id)->where('status','aktif')->with(['user'])->get();
        foreach($data_komentar as $komen)
        {
            $id_user         = $komen->user_id;
            $user   = User::where('id',$id_user)->with('profil')->get();
          
            $data_user[]=$user[0];

        }
        

        if($data_komentar)
        return response()->json([
            'success' => true,
            'data'  => $data_komentar,
            'users' => $data_user,
        ]);
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Komentar Tidak Ditemukan'
            ], 400);
        }
    }
}
