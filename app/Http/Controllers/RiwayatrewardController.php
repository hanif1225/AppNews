<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\History_Reward;
use Illuminate\Support\Str;


class RiwayatrewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir= $request->tanggal_akhir;

        $no = 0;
        $id = auth()->user()->id;
        if($tanggal_awal != '')
        {

                    return view('user.reward.riwayat', [
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
                return view('user.reward.riwayat', [
                    'jumlah_point' => Reward::where('user_id',$id)->get(),
                    "data_history" => History_Reward::with(['user'])
                        ->where('user_id',$id)->latest()
                        // ->filter(request(['search']))
                        ->paginate(20)->withQueryString(),
                    "no" => $no,
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
