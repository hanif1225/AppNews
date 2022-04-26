<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profil_user;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Iklan;
use App\Models\Iklanads;
use App\Models\Category;
use App\Models\Komentar;
use File;

class IklanController extends Controller
{
    public function index()
    {
        $postingan = Postingan::with(['category','user'])->where('status','aktif')->latest();
        
        $no = 0;
        return view('superadmin.iklan.index', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','aktif')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
            "no2" => $no,
            "iklan" => Iklan::with(['postingan','user'])
                       ->filter(request(['postingan','pengguna']))
                       ->get(),

        ]);

    }

    public function store(Request $request)
    {

        Iklan::create(
            [
                'user_id'           => $request->user_id,
                'postingan_id'      => $request->postingan_id,
                'tanggal_mulai'     => $request->tanggal_mulai,
                'tanggal_berakhir'  => $request->tanggal_berakhir,
            ]);

            $data= array(
                'iklan'    =>  "aktif",
            );
            Postingan::whereId($request->postingan_id)->update($data);

            return redirect('iklan')->with('pesan', 'Aktivasi Iklan Berhasil');
    }

    public function update(Request $request, $id)
    {
       
            $data= array(
                'tanggal_mulai'    =>  $request->tanggal_mulai,
                'tanggal_berakhir' =>  $request->tanggal_berakhir,
            );
            Iklan::whereId($id)->update($data);

        return redirect('iklan')->with('pesan', 'Berhasil Melakukan Perpanjangan');
    }


    public function iklan_ads()
    {
        $no = 1;
        return view('superadmin.iklan.ads', [
            "data" => Iklanads::all(),
            "no" => $no,
        ]);
    }

    public function edit($id)
    {
        $data = Iklanads::find($id);

        return view('superadmin.iklan.edit',compact('data'));  
    }


    public function create()
    {
        return view('superadmin.iklan.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'isi' => 'required',
            'judul' => 'required|unique:iklan_ads',
        ],
        [
            'isi.required' => 'Wajib di Isi',
            'Judul.required' => 'Wajib di Isi',
        ]);

        Iklanads::create(
            [
                'isi'       => $request->isi,
                'judul'     => $request->judul,
            ]);
            return redirect('/iklan-ads')->with('pesan', 'Data Berhasil Di Simpan');
    }

    public function update_ads(Request $request,$id)
    {
        $request->validate([
            'isi' => 'required',
            'judul' => 'required|unique:iklan_ads',
        ],
        [
            'isi.required' => 'Wajib di Isi',
            'Judul.required' => 'Wajib di Isi',
        ]);
        $data= array(
            'isi'    =>  $request->isi,
            'judul'   =>  $request->judul,
        );
        Iklanads::whereId($id)->update($data);
        return redirect('/iklan-ads')->with('pesan', 'Berhasil edit data');
    }

    public function destroy($id)
    {
        $data   = Iklanads::find($id);

        $data->delete();
        return redirect()->back()->with('pesan', 'Data berhasil di hapus');
    }



    


}
