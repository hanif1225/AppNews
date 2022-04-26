<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reward;
use App\Models\Postingan;
use App\Models\Pengajuan;
use App\Models\Nominal;
use App\Models\History_Reward;

class TransaksirestController extends Controller
{

    public function history(Request $request)
    {
        $id = auth()->user()->id;
        $history = Pengajuan::with(['user','reward'])
                    ->where('user_id',$id)
                    ->latest()
                    ->paginate(10)->withQueryString();

                    if($history) 
                    {
                        return response()->json([
                        'success' => true,
                        'data' => $history,
                        ]);
                    }
                    else
                    {
                        return response()->json([
                        'success' => false,
                        'message' => 'Tidak ada history transaksi point'
                        ], 400);
                    }
    }

    public function transaksi(Request $request, $id)
    {
        $data_nominal   = Nominal::find(1);
        $isi            = $data_nominal->harga;
        $tanggal        = date("Y-m-d");
        $user_id        = auth()->user()->id;
        $pengajuan      = $request->pengajuan;
        $total          = $pengajuan * $isi;  
        $pegajuan= Pengajuan::create([
                    'user_id'   => $user_id,
                    'pengajuan' => $pengajuan,
                    'nominal'   => $total,
                    'status'    => "pending",
                    'reward_id' => $id,
                    'tanggal'   => $tanggal,
                ]);
        if($pegajuan) 
        {
            return response()->json([
            'success' => true,
            'message' => 'Pengajuan transaksi telah dikirim silahkan tunggu konfirmasi dari admin'
            ]);
        }
        else
        {
            return response()->json([
            'success' => false,
            'message' => 'Pengajuan gagal'
            ], 400);
        }
    }




}
