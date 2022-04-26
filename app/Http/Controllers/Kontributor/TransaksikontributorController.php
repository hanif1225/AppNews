<?php

namespace App\Http\Controllers\Kontributor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reward;
use App\Models\Postingan;
use App\Models\Pengajuan;
use App\Models\Nominal;
use App\Models\History_Reward;


class TransaksikontributorController extends Controller
{
    public function history(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir= $request->tanggal_akhir;

        $no = 0;
        $id = auth()->user()->id;
        if($tanggal_awal != '')
        {
            return view('kontributor.reward.history_transaksi', [
                "data_history" => Pengajuan::with(['user','reward'])
                    ->where('user_id',$id)
                    ->whereBetween('tanggal',[$tanggal_awal,$tanggal_akhir])
                    ->orderBy('tanggal','ASC')
                    ->paginate(20)->withQueryString(),
                "no" => $no,
            ]);
        }
        else
        {
            return view('kontributor.reward.history_transaksi', [
                "data_history" => Pengajuan::with(['user','reward'])
                    ->where('user_id',$id)->latest()
                    ->paginate(20)->withQueryString(),
                "no" => $no,
            ]);
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
        Pengajuan::create([
            'user_id'   => $user_id,
            'pengajuan' => $pengajuan,
            'nominal'   => $total,
            'status'    => "pending",
            'reward_id' => $id,
            'tanggal'   => $tanggal,
        ]);

        return redirect('/history-transaksi-kontributor')->with('pesan', 'Pengajuan transaksi telah dikirim silahkan tunggu konfirmasi dari admin');
    }
}
