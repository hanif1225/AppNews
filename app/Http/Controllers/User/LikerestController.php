<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profil_user;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use File;

class LikerestController extends Controller
{
    public function like ($id)
    {
        
        $like = Like::where('postingan_id',$id)->where('user_id',auth()->user()->id)->first();
        if($like)
        {
            //mencari data postingan
            $data_postingan = Postingan::find($id);
            //mengurangi data trending
            $hasil_trending = $data_postingan->trending;
            $dt_trending = $hasil_trending-2;
            //mengurangi data like
            $hasil_like = $data_postingan->like;
            $dt_like   = $hasil_like-1;
            
            $data= array(
                'trending'       => $dt_trending,
                'like'           => $dt_like,
            );

            Postingan::find($id)->update($data);

            $like->delete();
            $data_like = Like::where('postingan_id',$id)->count();
            return response()->json([
                'success' => true,
                'data' => $data_like,
            ]);

        }
        else
        {
            //mencari data postingan
            $data_postingan = Postingan::find($id);
            //menambah data trending
            $hasil_trending = $data_postingan->trending;
            $dt_trending = $hasil_trending+2;
            //menambah data like
            $hasil_like = $data_postingan->like;
            $dt_like   = $hasil_like+1;
            
            $data= array(
                'trending'       => $dt_trending,
                'like'           => $dt_like,
            );

            Postingan::find($id)->update($data);

            Like::create([
                'postingan_id' => $id,
                'user_id'      => auth()->user()->id,

            ]);
            $data_like = Like::where('postingan_id',$id)->count();
            return response()->json([
                'success' => true,
                'data' => $data_like,
            ]);
        }
    }
    
    public function show_like($id)
    {
        $data_like = Like::where('postingan_id',$id)->count();
        if($data_like)
        return response()->json([
            'success' => true,
            'data' => $data_like,
        ]);
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah Like Tidak Ditemukan'
            ], 400);
        }
    }

    public function cek_like($id)
    {
        $like = Like::where('postingan_id',$id)->where('user_id',auth()->user()->id)->first();
        return response()->json([
            'data'    => $like,
        ]);
        
    }

}
