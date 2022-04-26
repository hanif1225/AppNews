<?php

namespace App\Http\Controllers\SuperAdmin;
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

class LikeController extends Controller
{
    public function like($postingan_id)
    {
        $like = Like::where('postingan_id',$postingan_id)->where('user_id',auth()->user()->id)->first();
        if($like)
        {
            $data_postingan = Postingan::find($postingan_id);
            $hasil_trending = $data_postingan->trending;
            $dt_trending = $hasil_trending-2;

            $hasil_like = $data_postingan->like;
            $dt_like   = $hasil_like-1;
            
            $data= array(
                'trending'       => $dt_trending,
                'like'           => $dt_like,
            );

            Postingan::find($postingan_id)->update($data);

            $like->delete();
            return back();
        }
        else
        {
            $data_postingan = Postingan::find($postingan_id);
            $hasil_trending = $data_postingan->trending;
            $dt_trending = $hasil_trending+2;

            $hasil_like = $data_postingan->like;
            $dt_like   = $hasil_like+1;
            
            $data= array(
                'trending'       => $dt_trending,
                'like'           => $dt_like,
            );

            Postingan::find($postingan_id)->update($data);
            
            Like::create([
                'postingan_id' => $postingan_id,
                'user_id'      => auth()->user()->id,

            ]);
            return back();
        }
    }
}
