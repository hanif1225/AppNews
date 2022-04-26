<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profil_user;
use App\Models\Category;
use App\Models\Postingan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Komentar;
use App\Models\History;
use App\Models\Statistik;
use App\Models\Like;
use App\Models\Iklan;
use File;

class PostinganrestController extends Controller
{

    public function index()
    {
      
        $postingan =  Postingan::with(['category','user','like'])->where('status','aktif')
                      ->limit(10)->latest('updated_at')->get();
        
        foreach($postingan as $post)
        {
            $id_post         = $post->id;
            $data_like       = Like::where('postingan_id',$id_post)->count();
            $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
            if($data_like == null)
            {
                $data_like = 0;
            }
            if($data_komentar == null)
            {
                $data_komentar= 0;
            }
            
            $data_hasil[]=$data_like;
            $data_hasil2[]=$data_komentar;
        }
      
        
        if ($postingan) {
        return response()->json([
            'success'          => true,
            'data'             => $postingan,
            'jumlah_like'      => $data_hasil,
            'jumlah_komentar'  => $data_hasil2,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }

    }
    public function search(Request $request)
    {
            $cari = $request->cari;
            $postingan = Postingan::with(['category','user'])
            ->where('status','aktif')->where('judul','like',"%".$cari."%")->get();

            foreach($postingan as $post)
            {
                $id_post         = $post->id;
                $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
                
                if($data_komentar == null)
                {
                    $data_komentar= 0;
                }
                
                $data_hasil2[]=$data_komentar;
            }

            if ($postingan) {
                return response()->json([
                    'success'          => true,
                    'data'             => $postingan,
                    'jumlah_komentar'  => $data_hasil2,
                ]);
                }
                else
                {
                    return response()->json([
                        'success' => false,
                        'message' => 'Postingam Tidak Di temukan'
                    ], 400);
                }

    }

    public function trending()
    {
        $postingan = Postingan::with(['category','user'])
        ->where('status','aktif')
        ->whereYear('tanggal',2021)
        ->limit(10)->orderBy('trending','desc')->get();

        foreach($postingan as $post)
        {
            $id_post         = $post->id;
            $data_like       = Like::where('postingan_id',$id_post)->count();
            $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
            if($data_like == null)
            {
                $data_like = 0;
            }
            if($data_komentar == null)
            {
                $data_komentar= 0;
            }
            
            $data_hasil[]=$data_like;
            $data_hasil2[]=$data_komentar;
        }

        if ($postingan) {
            return response()->json([
                'success'          => true,
                'data'             => $postingan,
                'jumlah_like'      => $data_hasil,
                'jumlah_komentar'  => $data_hasil2,
            ]);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Postingam Tidak Di temukan'
                ], 400);
            }
    }

    public function show($id)
    {
        $postingan = Postingan::with(['category','user'])->where('id',$id)->get();
        $postingan2 = Postingan::find($id);
        $views = Postingan::where('id',$id)->increment('views');
        $trending = Postingan::where('id',$id)->increment('trending');

        $tanggal        = date("Y-m-d");
                // menghapus iklan
                $data= array(
                    'iklan'    =>  null,
                );
        
                $iklan = Iklan::where('tanggal_berakhir',$tanggal)->first();
                if($iklan != null)
                {
                    $iklan->delete();
                    Postingan::find($iklan->postingan_id)->update($data);
                }


        //tambah statistik
        Statistik::create(
            [
                'user_id'           => $postingan2->user_id,
                'status_iklan'      => $postingan2->iklan,
                'tanggal'           => $tanggal,
                'judul'             => $postingan2->judul,
                'postingan_id'      => $postingan2->id,
            ]);

        if (!$postingan) {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }
        else
        {
        return response()->json([
            'success' => true,
            'data' => $postingan,
        ]); 
        }
    }

    public function category()
    {
        $tanggal        = date("Y-m-d");
        // menghapus iklan
        $data= array(
            'iklan'    =>  null,
        );

        $iklan = Iklan::where('tanggal_berakhir',$tanggal)->first();
        if($iklan != null)
        {
            $iklan->delete();
            Postingan::find($iklan->postingan_id)->update($data);
        }
        
        $data_category =  Category::with('postingan')->get();

        return response()->json([
            'success' => true,
            'data'    => $data_category,
        ]);
    }

    public function postingan_category(Request $request, $id)
    {
    if($request->limit != null)
    {
        $data_postingan =  Postingan::with(['category','user'])
                            ->where('status','aktif')
                            ->where('category_id',$id)->limit($request->limit)->get();
    }
    elseif($request->limit == null)
    {
        $data_postingan =  Postingan::with(['category','user'])
            ->where('status','aktif')
            ->where('category_id',$id)->get();
    }

    foreach($data_postingan as $post)
    {
        $id_post         = $post->id;
        $data_like       = Like::where('postingan_id',$id_post)->count();
        $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
        if($data_like == null)
        {
            $data_like = 0;
        }
        if($data_komentar == null)
        {
            $data_komentar= 0;
        }
        
        $data_hasil[]=$data_like;
        $data_hasil2[]=$data_komentar;
    }

        if($data_postingan) 
        {
            return response()->json([
                'success' => true,
                'data'    => $data_postingan,
                'jumlah_like'      => $data_hasil,
                'jumlah_komentar'  => $data_hasil2,
                
                ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
                ], 400);
        }
    }

//untuk menampilkan postingan terbaru di category
    public function postnew_category(Request $request, $id)
    {
        if($request->limit != null)
        {

            $data_postingan =  Postingan::with(['category','user'])
                                ->where('status','aktif')
                                ->where('category_id',$id)->latest('updated_at')->limit($request->limit)->get();
        }
        elseif($request->limit == null)
        {
            $data_postingan =  Postingan::with(['category','user'])
                                ->where('status','aktif')
                                ->where('category_id',$id)->latest('updated_at')->get();
        }

        foreach($data_postingan as $post)
        {
            $id_post         = $post->id;
            $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();

                if($data_komentar == null)
                {
                    $data_komentar= 0;
                }
    
            $data_hasil2[]=$data_komentar;
        }

        if($data_postingan) 
        {
            return response()->json([
                'success' => true,
                'data'    => $data_postingan,
                'jumlah_komentar'  => $data_hasil2,
                
                ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
                ], 400);
        }
    }
//end untuk menampilkan postingan terbaru di category

// Untuk menampilkan trending kategori
    public function trending_category(Request $request, $id)
    {
        if($request->limit != null)
        {
            $postingan = Postingan::with(['category','user'])
            ->where('status','aktif')->where('category_id',$id)
            ->whereYear('tanggal',2021)
            ->limit($request->limit)->orderBy('trending','desc')->get();
        }
        elseif($request->limit == null)
        {
            $postingan = Postingan::with(['category','user'])
            ->where('status','aktif')->where('category_id',$id)
            ->whereYear('tanggal',2021)
            ->orderBy('trending','desc')->get();
        }

        foreach($postingan as $post)
        {
            $id_post         = $post->id;
            $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
            if($data_komentar == null)
            {
                $data_komentar= 0;
            }
            
            $data_hasil2[]=$data_komentar;
        }
        
        if ($postingan) 
        {
            return response()->json([
                'success'          => true,
                'data'             => $postingan,
                'jumlah_komentar'  => $data_hasil2,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }
    }
// End Untuk menampilkan trending kategori

//untuk menampilkan postingan berdasarkan user
    public function postingan_user($id)
    {
            $data_postingan =  Postingan::with(['category','user'])
                                ->where('status','aktif')
                                ->where('user_id',$id)
                                ->paginate(10)->withQueryString();

            $data_postingan2 =  Postingan::with(['category','user'])
                                ->where('status','aktif')
                                ->where('user_id',$id)->get();

            foreach($data_postingan2 as $post)
            {
                $id_post         = $post->id;
                $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();

                    if($data_komentar == null)
                    {
                        $data_komentar= 0;
                    }

                $data_hasil2[]=$data_komentar;
            }

            if($data_postingan) 
            {
                return response()->json([
                'success' => true,
                'data'    => $data_postingan,
                'jumlah_komentar'  => $data_hasil2,
                ]);
            }
            else
            {
                return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
                ], 400);
            }
    }

    public function iklan()
    {
        $postingan =  Postingan::with(['category','user','like'])->where('status','aktif')->where('iklan','aktif')
                      ->get();
        
        foreach($postingan as $post)
        {
            $id_post         = $post->id;
            $data_like       = Like::where('postingan_id',$id_post)->count();
            $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
            if($data_like == null)
            {
                $data_like = 0;
            }
            if($data_komentar == null)
            {
                $data_komentar= 0;
            }
            
            $data_hasil[]=$data_like;
            $data_hasil2[]=$data_komentar;
        }
      
        
        if ($postingan) {
        return response()->json([
            'success'          => true,
            'data'             => $postingan,
            'jumlah_like'      => $data_hasil,
            'jumlah_komentar'  => $data_hasil2,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }
    }

//end untuk menampilkan postingan berdasarkan user

}
