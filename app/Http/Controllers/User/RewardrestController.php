<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Reward;
use App\Models\Postingan;
use App\Models\Point;
use App\Models\History_Reward;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class RewardrestController extends Controller
{
    public function reward(Postingan $postingan)
    {
        $id = auth()->user()->id;
        $jml_history = History_Reward::where('user_id',$id)->where('slug',$postingan->slug)->count();

        if($jml_history > 0)
        {

        }
        else
        {
            $reward = Reward::where('user_id',$id)->first();
            $dtpoint = Point::find(1);
            $isi_point = $dtpoint->point_baca;
            $tanggal        = date("Y-m-d");
            if($reward)
            {

                $data_reward = $reward->point;
                $hasil_reward = $data_reward + $isi_point;

                $data= array(
                'point'           =>$hasil_reward ,
                );
                //mengupdate reward
                Reward::where('user_id',$id)->update($data);
                //menambah history reward
                History_Reward::create([
                    'user_id'      => $id,
                    'point'        => $isi_point,
                    'slug'         => $postingan->slug,
                    'aktivitas'    => "Telah Melihat Postingan ".$postingan->judul." selama 1 menit",
                    'tanggal'      => $tanggal,
                ]);

                if($data)
                {
                    return response()->json([
                        'success' => true,
                        'message' => "Selamat anda mendapatkan ".$isi_point." point" ,
                    ]);
                }

            }
            else
            {
                $hasil= Reward::create([
                    'user_id'      => $id,
                    'point'        => $isi_point
                ]);
                //menambah history reward
                History_Reward::create([
                    'user_id'      => $id,
                    'slug'         => $postingan->slug,
                    'point'        => $isi_point,
                    'aktivitas'    => "Telah Melihat Postingan ".$postingan->judul." selama 1 menit",
                    'tanggal'      => $tanggal,
                ]);
                
                if($hasil)
                {
                    return response()->json([
                        'success' => true,
                        'message' => "Selamat anda mendapatkan ".$isi_point." point" ,
                    ]);
                }
            }

        }

    }


    public function show($id)
    {
        $reward = Reward::where('user_id',$id)->first();
        if($reward)
        {
            return response()->json([
                'success' => true,
                'data' => $reward ,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'data' => 0 ,
            ]);
        }
    }

    public function history_reward()
    {
        $id = auth()->user()->id;
        $data= History_Reward::where('user_id',$id)
                ->paginate(30)->withQueryString();

                if($data) 
                {
                    return response()->json([
                    'success' => true,
                    'data'    => $data,
                    ]);
                }
                else
                {
                    return response()->json([
                    'success' => false,
                    'message' => 'History Rewards Tidak Di Temukan'
                    ], 400);
                }

    }

}
