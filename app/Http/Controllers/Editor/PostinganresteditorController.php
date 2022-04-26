<?php

namespace App\Http\Controllers\Editor;

use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\History_Reward;
use App\Models\Category;
use App\Models\Reward;
use Illuminate\Support\Str;
use File;

class PostinganresteditorController extends Controller
{
    public function posteditor(Request $request)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {
            $status = $request->status;
            $data_postingan =  Postingan::with(['category','user'])
                                ->where('status',$status)
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
    }

    public function publish(Request $request, Postingan $postingan)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {

            $data= array(
                'status'    =>  "aktif",
            );
            $update = Postingan::where('id',$postingan->id)->update($data);
            
        $reward = Reward::where('user_id',$postingan->user_id)->first();
        
        $tanggal        = date("Y-m-d");
        History_Reward::create([
            'user_id'      => $postingan->user_id,
            'point'        => $request->point,
            'aktivitas'    => "Artikel ".$postingan->judul." telah publish",
            'tanggal'      => $tanggal,
        ]);

        if($reward)
        {
            $data_point   = $request->point;
            $data_reward  = $reward->point;
            $hasil_reward = $data_reward + $data_point;

            $data= array(
             'point'           =>$hasil_reward ,
            );

            Reward::where('user_id',$postingan->user_id)->update($data);

        }
        else
        {
            $hasil= Reward::create([
                'user_id'      => $postingan->user_id,
                'point'        => $request->point
            ]);
        }

            if($update){
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan Berhasil Di publish'
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'data gagal di update'
                ], 400);
            }
            //penutup else
        }
        //penutup else
    }

    //proses editing
    public function editing(Postingan $postingan)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {
            $data= array(
                'status'    =>  "editing",
            );
            $update= Postingan::where('id', $postingan->id)->update($data);

            if($update){
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan Berhasil Di Update'
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
    }

    //edit data
    public function update(Request $request, Postingan $postingan)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {

                if($postingan->judul == $request->judul)
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
                    'user_id'       => $postingan->user_id,
                    'judul'         => $judul,
                    'slug'          => Str::slug($request->judul),
                    'category_id'   => $request->category_id,
                    'isi'           => $request->isi,
                    'tanggal'       => $request->tanggal,
                    'lokasi'        => $request->lokasi,
                    'gambar'        => $image_name,
                    'status'        => "selesai",
                    'views'         => $views,
                    'alasan'        => " ",
                );

                $update = Postingan::find($postingan->id)->update($data);

                if($update){
                    return response()->json([
                        'success' => true,
                        'message' => 'Data berhasil di update'
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
    }

    public function update_aktif(Request $request, Postingan $postingan)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {

                if($postingan->judul == $request->judul)
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
                    'user_id'       => $postingan->user_id,
                    'judul'         => $judul,
                    'slug'          => Str::slug($request->judul),
                    'category_id'   => $request->category_id,
                    'isi'           => $request->isi,
                    'tanggal'       => $request->tanggal,
                    'lokasi'        => $request->lokasi,
                    'gambar'        => $image_name,
                    'status'        => "aktif",
                    'views'         => $views,
                    'alasan'        => " ",
                );

                $update = Postingan::find($postingan->id)->update($data);

                if($update){
                    return response()->json([
                        'success' => true,
                        'message' => 'Data berhasil di update'
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
    }



    //draft
    public function simpan_draft(Request $request, Postingan $postingan)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {

                if($postingan->judul == $request->judul)
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
                    'user_id'       => $postingan->user_id,
                    'judul'         => $judul,
                    'slug'          => Str::slug($request->judul),
                    'category_id'   => $request->category_id,
                    'isi'           => $request->isi,
                    'tanggal'       => $request->tanggal,
                    'lokasi'        => $request->lokasi,
                    'gambar'        => $image_name,
                    'status'        => "draft admin",
                    'views'         => $views,
                    'alasan'        => " ",
                );

                $update = Postingan::find($postingan->id)->update($data);

                if($update){
                    return response()->json([
                        'success' => true,
                        'message' => 'Data berhasil di update'
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
    }



    public function rejected(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->level != "editor") 
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Buka Editor'
            ], 400);
        }
        else
        {

            $validateData['excerpt'] = Str::limit(strip_tags($request->alasan), 200);

            $data= array(
                'status'    =>  "ditolak",
                'alasan'    =>  strip_tags($request->alasan),
            );
            $update = Postingan::where('id',$id)->update($data);

            if($update){
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan Berhasil Di Tolak'
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'data gagal di update'
                ], 400);
            }
            //penutup else
        }   
        //penutup else
    }


}
