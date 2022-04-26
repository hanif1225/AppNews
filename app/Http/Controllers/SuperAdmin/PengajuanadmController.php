<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\Nominal;
use App\Models\Pengajuan;
use App\Models\Reward;
use Illuminate\Http\Request;

class PengajuanadmController extends Controller
{
    public function index()
    {
        $no= 1;
        return view('superadmin.reward.pengajuan', [
            "pengajuan"=> Pengajuan::with(['user','reward'])
                            ->where('status','pending')->orderBy('id', 'ASC')
                            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function riwayat()
    {
        $no = 1;
        return view('superadmin.reward.riwayat', [
            "pengajuan"=> Pengajuan::with(['user','reward'])
                            ->where('status','diterima')->orWhere('status','ditolak')
                            ->orderBy('id', 'DESC')
                            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }
    

    public function update(Request $request, $id)
    {
            $data= array(
                'harga'    =>  $request->harga,
            );
            Nominal::whereId($id)->update($data);

        return redirect('/pengajuan/reward')->with('pesan', 'Berhasil edit data');
    }
    
    public function update_transaksi($id)
    {
        $data_pengajuan   = Pengajuan::find($id);
        $reward_id        = $data_pengajuan->reward_id;
        $data_reward      = Reward::find($reward_id);
        $isi_point = $data_reward->point;
        $isi_pengajuan = $data_pengajuan->pengajuan;
        $point_reward     =  $isi_point-$isi_pengajuan;
        $data1 = array(
            'status'     => "diterima",
        );
        $data2 = array(
            'point'     => $point_reward,
        );

        Pengajuan::find($id)->update($data1);
        Reward::find($reward_id)->update($data2);
        return redirect('/riwayat/reward')->with('pesan', 'Postingan Berhasil di Tambahkan');

    }
}
