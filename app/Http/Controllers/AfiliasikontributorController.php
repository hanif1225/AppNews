<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Afiliasi;
use App\Models\Reward;
use App\Models\Point;
use App\Models\History_Reward;

class AfiliasikontributorController extends Controller
{
    public function index()
    {
        $id= auth()->user()->id;

        $no = 0;
        return view('afiliasi.index2', [
            "data"          => Afiliasi::where('user_id',$id)->get()
        ]);

    }

    public function update(Request $request,$id)
    {
        $tanggal        = date("Y-m-d");
        $user_id= auth()->user()->id;
        
        //untuk mengambil data afiliasi
        $data = Afiliasi::find($id);

        $data_pengundang = Afiliasi::where('kode_afiliasi',$request->kode_undangan)->first();

        if($data->kode_afiliasi != $request->kode_undangan)
        {
            if($data_pengundang)
            {
                //proses memasukkan afiliasi undangan
                $isi= array(
                    'kode_undangan'       => $request->kode_undangan,
                );

                Afiliasi::find($id)->update($isi);

                //
                //umtuk mengambil data point
                $dtpoint = Point::find(1);
                $isi_point = $dtpoint->point_referal;
                //untuk mengambil reward
                $reward = Reward::where('user_id',$user_id)->first();
                if($reward)
                {
                    //meanmbah point
                    $data_reward = $reward->point;
                    $hasil_reward = $data_reward + $isi_point;
                    $data= array(
                        'point'           =>$hasil_reward,
                        );
                        //mengupdate reward
                    Reward::where('user_id',$user_id)->update($data);

                    //menambah history reward

                    History_Reward::create([
                        'user_id'      => $user_id,
                        'point'        => $isi_point,
                        'aktivitas'    => "Telah manambahkan kode undangan",
                        'tanggal'      => $tanggal,
                    ]);
                }
                else
                {
                    $hasil= Reward::create([
                        'user_id'      => $user_id,
                        'point'        => $isi_point
                    ]);
                    //menambah history reward
                    History_Reward::create([
                        'user_id'      => $user_id,
                        'point'        => $isi_point,
                        'aktivitas'    => "Telah manambahkan kode undangan",
                        'tanggal'      => $tanggal,
                    ]);
                }
                    //proses untuk pengundang
                    $id_pengundang = $data_pengundang->user_id;

                    $reward2 = Reward::where('user_id',$id_pengundang)->first();

                    if($reward2)
                    {
                        //menambah point
                        $data_reward2 = $reward2->point;
                        $hasil_reward2 = $data_reward2 + $isi_point;
                        $data2= array(
                            'point'           =>$hasil_reward2,
                            );
                            //mengupdate reward
                        Reward::where('user_id',$id_pengundang)->update($data2);

                        History_Reward::create([
                            'user_id'      => $id_pengundang,
                            'point'        => $isi_point,
                            'aktivitas'    => "Kode undangan telah digunakan oleh pengguna lain",
                            'tanggal'      => $tanggal,
                        ]);
                    }
                    else
                    {
                        $hasil= Reward::create([
                            'user_id'      => $id_pengundang,
                            'point'        => $isi_point
                        ]);
                        //menambah history reward
                        History_Reward::create([
                            'user_id'      => $id_pengundang,
                            'point'        => $isi_point,
                            'aktivitas'    => "Kode undangan telah digunakan oleh pengguna lain",
                            'tanggal'      => $tanggal,
                        ]);
                    }

                    return redirect()->back()->with('pesan', 'Kode Undangan Berhasil Dimasukkan');
            }
            else
            {
                return redirect()->back()->with('error', 'Kode Undangan Tidak Sesuai');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Kode udangan tidak boleh sama dengan kode afiliasi pribadi');
        }
    }
}
