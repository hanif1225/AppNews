<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\History_Reward;
use Illuminate\Support\Str;

class RiwayatrewardkontributorController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir= $request->tanggal_akhir;

        $no = 0;
        $id = auth()->user()->id;
        if($tanggal_awal != '')
        {

                    return view('kontributor.reward.riwayat', [
                        'jumlah_point' => Reward::where('user_id',$id)->get(),
                        "data_history" => History_Reward::with(['user'])
                            ->where('user_id',$id)
                            ->whereBetween('tanggal',[$tanggal_awal,$tanggal_akhir])
                            ->orderBy('tanggal','ASC')
                            ->paginate(20)->withQueryString(),
                        "no" => $no,
                    ]);
        }
        else
        {
                return view('kontributor.reward.riwayat', [
                    'jumlah_point' => Reward::where('user_id',$id)->get(),
                    "data_history" => History_Reward::with(['user'])
                        ->where('user_id',$id)->latest()
                        // ->filter(request(['search']))
                        ->paginate(20)->withQueryString(),
                    "no" => $no,
                ]);
        }
    }

    
}
