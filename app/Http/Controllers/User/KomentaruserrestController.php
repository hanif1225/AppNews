<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;

class KomentaruserrestController extends Controller
{
    public function index()
    {   
        $user = auth()->user();
        if($user == null)
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Belum Login'
            ], 500);
        }
        else
        {
            $data_komentar =  Komentar::with(['Postingan','user'])->where('status','aktif')->where('user_id',$user->id)->get();
        
            return response()->json([
                'success' => true,
                'data' => $data_komentar,
            ]);
        }
       //penutup else
    }

    public function pending()
    {
        $user = auth()->user();
        if($user == null)
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Belum Login'
            ], 500);
        }
        else
        {
            $data_komentar =  Komentar::with(['Postingan','user'])->where('status','pending')->where('user_id',$user->id)->get();
            
            return response()->json([
                'success' => true,
                'data' => $data_komentar,
            ]);
        }
    }

    public function ditolak()
    {
        $user = auth()->user();
        if($user == null)
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Belum Login'
            ], 500);
        }
        else
        {
            $data_komentar =  Komentar::with(['Postingan','user'])->where('status','ditolak')->where('user_id',$user->id)->get();
            
            return response()->json([
                'success' => true,
                'data' => $data_komentar,
            ]);
        }
    }


    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        $komen= Komentar::create(
            [
                'user_id'       => $user_id,
                'postingan_id'  => $request->postingan_id,
                'isi'           => $request->isi,
                'status'        => "pending",
            ]);

        if($komen)
        {
            return response()->json([
                'success' => true,
                'data' => $komen,
            ]);
        }
        else
        {
        return response()->json([
            'success' => false,
            'message' => 'Menyimpan Data Gagal'
        ], 500);
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


    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->level == null) 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Belum Login'
            ], 400);
        }
        else
        {
            $data_komentar   = Komentar::find($id);
            $delete = $data_komentar->delete();
            if($delete){
                return response()->json([
                    'success' => true,
                    'message' => 'Komentar berhasil di delete'
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal di delete'
                ], 400);
            }
            //penutup else
        }   
        //penutup else
    }


}
