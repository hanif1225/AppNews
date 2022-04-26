<?php

namespace App\Http\Controllers\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Postingan;
use App\Models\Komentar;
use App\Models\Category;
use App\Models\History;
use App\Models\Like;
use File;


class UserrestpostController extends Controller
{
    public function index()
    {
        $user = auth()->user()->postingan;
        
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);

    }
    public function pending()
    {
        $user = auth()->user();
        $data_postingan =  Postingan::with(['category','user'])
                            ->where('status','pending')
                            ->paginate(10)->withQueryString();

        if($user)
        {
        return response()->json([
            'success' => true,
            'data' => $data_postingan,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 400);
        }
    }

    public function editing()
    {
        $user = auth()->user();
        $data_postingan =  Postingan::with(['category','user'])
                            ->where('status','editing')
                            ->orWhere('status','selesai')->latest()
                            ->paginate(10)->withQueryString();

        if($user)
        {
        return response()->json([
            'success' => true,
            'data' => $data_postingan,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 400);
        }
    }

    public function store(Request $request)
    {
        //Mengambil gambar foto dan ktp
        $gambar = $request->gambar;
        $nama_gambar = $request->nama_gambar;
        $file = base64_decode($gambar);
        file_put_contents("postingan/".$nama_gambar,$file);
        
        $user_id = auth()->user()->id;
 
        $request->validate([
            'slug' => 'unique:postingan',
            'judul' => 'unique:postingan',
        ],
        [
            'slug.unique' => 'Slug Sudah Ada Yang Menggunakan Silahkan Masukkan Slug Baru',
            'judul.unique' => 'Judul Sudah Ada Yang Menggunakan Silahkan Masukkan Judul Baru',
        ]);

        $views=0;
        $trending=0;
        $like=0;

        $excerpt = Str::limit(strip_tags($request->isi), 200);
        
        $postingan = new Postingan();
        $postingan->user_id        = $user_id;
        $postingan->category_id    = $request->category_id;
        $postingan->judul          = $request->judul;
        $postingan->tanggal        = $request->tanggal;
        $postingan->lokasi         = $request->lokasi ;
        $postingan->isi            = $request->isi ;
        $postingan->slug           = Str::slug($request->judul);
        $postingan->status         = "pending";
        $postingan->views          = $views;
        $postingan->trending       = $trending;
        $postingan->like           = $like;
        $postingan->excerpt        = $excerpt;
        $postingan->gambar         = $nama_gambar;
 
        if (auth()->user()->posts()->save($postingan))
            return response()->json([
                'success' => true,
                'data' => $postingan->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan'
            ], 500);
    }

    public function draft(Request $request)
    {
        //Mengambil gambar foto dan ktp
        $gambar = $request->gambar;
        $nama_gambar = $request->nama_gambar;
        $file = base64_decode($gambar);
        file_put_contents("postingan/".$nama_gambar,$file);
        
        $user_id = auth()->user()->id;
 
        $request->validate([
            'slug' => 'unique:postingan',
            'judul' => 'unique:postingan',
        ],
        [
            'slug.unique' => 'Slug Sudah Ada Yang Menggunakan Silahkan Masukkan Slug Baru',
            'judul.unique' => 'Judul Sudah Ada Yang Menggunakan Silahkan Masukkan Judul Baru',
        ]);

        $views=0;
        $trending=0;
        $like=0;

        $excerpt = Str::limit(strip_tags($request->isi), 200);
        
        $postingan = new Postingan();
        $postingan->user_id        = $user_id;
        $postingan->category_id    = $request->category_id;
        $postingan->judul          = $request->judul;
        $postingan->tanggal        = $request->tanggal;
        $postingan->lokasi         = $request->lokasi ;
        $postingan->isi            = $request->isi ;
        $postingan->slug           = Str::slug($request->judul);
        $postingan->status         = "draft user";
        $postingan->views          = $views;
        $postingan->trending       = $trending;
        $postingan->like           = $like;
        $postingan->excerpt        = $excerpt;
        $postingan->gambar         = $nama_gambar;
 
        if (auth()->user()->posts()->save($postingan))
            return response()->json([
                'success' => true,
                'data' => $postingan->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan'
            ], 500);
    }


    public function postuser(Request $request)
    {
        $id = auth()->user()->id;
            $status = $request->status;
            $data_postingan =  Postingan::with(['category','user'])
                                ->where('status',$status)
                                ->where('user_id',$id)
                                ->latest()->paginate(20)
                                ->withQueryString();
       if($data_postingan)
        {
        return response()->json([
            'success' => true,
            'data' => $data_postingan,
        ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Postingan tidak ditemukan'
            ], 400);
        }
    }

    public function edit($id)
    {
        $post = auth()->user()->postingan()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $post->toArray(),
        ], 400); 
    }

    public function insert_history(Request $request)
    {
        $user_id      = $request->user_id;
        $postingan_id = $request->postingan_id;
        $data_postingan = Postingan::find($postingan_id);
        $j_history = History::where('user_id',$user_id)->count();
        if($j_history > 10)
        {
            $cek_history= History::where('user_id',$user_id)->min('id');
            $data_posting = History::where('id',$cek_history)->delete();
        }
        $history = History::where('postingan_id',$postingan_id)->where('user_id',$user_id)->first();
        
        if($history)
        {

        }
        else
        {
        History::create(
            [
            'user_id'       => $user_id,
            'postingan_id'  => $postingan_id,
            'slug'          => $data_postingan->slug,
            ]);
        }

        if ($user_id != ' ') {
            return response()->json([
                'success'          => true,
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


    public function history()
    {
        if(auth()->user() == null)
        {

        }
        elseif(auth()->user() != '')
        {
            $user_id = auth()->user()->id;
            $data_history= History::with(['user','postingan'])->where('user_id',$user_id )
            ->limit(10)->latest('updated_at')->get();
            $hasil_history = History::find($user_id);



            foreach($data_history as $post)
            {
                $id_post         = $post->postingan_id;
                $data_komentar   = Komentar::where('postingan_id',$id_post)->where('status','aktif')->count();
                
                if($data_komentar == null)
                {
                    $data_komentar= 0;
                }
                
                $data_hasil2[]=$data_komentar;
            }
        }
        if ($data_history != ' ') {
            return response()->json([
                'success'          => true,
                 'data'             => $data_history,
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

    public function destroy($id)
    {
        $post = auth()->user()->postingan()->find($id);

        File::delete('postingan/'.$post->gambar);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Postingam Tidak Di temukan'
            ], 400);
        }
        
        if ($post->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Postingan Berhasil di Delete'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Postingan tidak bisa di delete'
            ], 500);
        }
        
    }

    public function update(Request $request, $id)
    {
        $post = auth()->user()->postingan()->find($id);
        // Cek Judul
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Postingan tidak ditemukan'
            ], 400);
        }

        if($post->judul == $request->judul)
        {
            $request->validate([
                'judul' => 'max:255',
            ],
            [
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        else
        {
            $request->validate([
                'judul' => 'unique:postingan|max:255',
            ],
            [
                'judul.unique' => 'Judul Sudah Di Gunakan, Silahkan Gunakan Judul Lain',
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        
    //cek gambar
        $old_image_name = $request->old_image_name;
        $new_image_name = $request->new_image_name;
        $image          = $request->gambar;
        if($image != '')
        {

            $file  = base64_decode($image);
            
            $image_name=$new_image_name;
            unlink("postingan/".$old_image_name);
            file_put_contents("postingan/".$image_name,$file);
        }
        else
        {
            $image_name=$old_image_name;
        }
        
    //request data

        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 200);
        $views=0;
        $data= array(
            'user_id'       => $post->user_id,
            'judul'         => $judul,
            'slug'          => Str::slug($request->judul),
            'category_id'   => $request->category_id,
            'isi'           => $request->isi,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'gambar'        => $image_name,
            'status'        => "pending",
            'views'         => $views,
            'alasan'        => " ",
        );

        $update = Postingan::find($id)->update($data);

        if($update){
            return response()->json([
                'success' => true,
                'message' => 'data berhasil di update'
            ], 200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'data gagal di update'
            ], 400);
        }
        
    }

    public function data_iklan()
    {
        $user_id = auth()->user()->id;
        $postingan =  Postingan::with(['category','user'])
                     ->where('status','aktif')
                     ->where('user_id',$user_id)
                     ->where('iklan','aktif')
                     ->latest('updated_at')
                     ->paginate(10)->withQueryString();

        $postingan2 =  Postingan::with(['category','user'])
                     ->where('status','aktif')
                     ->where('user_id',$user_id)
                     ->where('iklan','aktif')->first();


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
      
        
        if ($postingan2) {
        return response()->json([
            'success'          => true,
            'data'             => $postingan,
            'jumlah_komentar'  => $data_hasil2
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

}
