<?php

namespace App\Http\Controllers\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;

class KomentarrestController extends Controller
{
    public function index()
    {   
        $user = auth()->user()->level;
        if($user != "editor")
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Bukan editor'
            ], 500);
        }
        else
        {
            $data_komentar =  Komentar::with(['Postingan','user'])->where('status','aktif')->get();
        
            return response()->json([
                'success' => true,
                'data' => $data_komentar,
            ]);
        }
       
    }

    public function pending()
    {
        $user = auth()->user()->level;
        if($user != "editor")
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Bukan editor'
            ], 500);
        }
        else
        {
        $data_komentar =  Komentar::with(['Postingan','user'])->where('status','pending')->get();
        
        return response()->json([
            'success' => true,
            'data' => $data_komentar,
        ]);
        }
    }

    public function ditolak()
    {
        $user = auth()->user()->level;
        if($user != "editor")
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Bukan editor'
            ], 500);
        }
        else
        {
        $data_komentar =  Komentar::with(['Postingan','user'])->where('status','ditolak')->get();
        
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
    
    }

    public function update($id)
    {
        $user = auth()->user()->level;
        if($user != "editor")
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf Anda Bukan editor'
            ], 500);
        }
        else
        {
            $data= array(
                'status'        => "aktif",
            );
    
            $update = Komentar::find($id)->update($data);
            if($update)
            {
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
            //penutup else
        }
        //penutup else
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

  
            $data= array(
                'status'    =>  "ditolak",
                'alasan'    =>  $request->alasan,
            );
            $update = Komentar::where('id',$id)->update($data);

            if($update){
                return response()->json([
                    'success' => true,
                    'message' => 'Komentar Berhasil Di Tolak'
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

    public function destroy($id)
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
