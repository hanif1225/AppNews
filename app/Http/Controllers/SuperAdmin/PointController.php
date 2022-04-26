<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Nominal;

class PointController extends Controller
{
    public function index()
    {
        $postingan = Nominal::all();
        return view('superadmin.reward.point', [
            "nominal"       => Nominal::all(),
            "data_point"    => Point::all(),
        ]);
    }

    public function store(Request $request)
    {
        Point::create([
            'point_baca'    => $request->point_baca,
            'point_post'    => 0,
            'point_referal' => $request->point_referal,
        ]);
        return redirect('/kelola-point')->with('pesan', 'Data Berhasil di Tambahkan');
    }

    public function update(Request $request, $id)
    {
        $data= array(
            'point_baca'       =>  $request->point_baca,
            'point_post'       =>  0,
            'point_referal'    =>  $request->point_referal,
        );

        Point::whereId($id)->update($data);
        return redirect('/kelola-point')->with('pesan', 'Data Berhasil di Edit');
    }
}
