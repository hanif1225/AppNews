<?php

namespace App\Http\Controllers\Kontributor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;

class KomentarkontributorController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $no = 0;
        return view('kontributor.komentar.index', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','aktif')->where('user_id',$user_id)->latest()
            ->filter(request(['search','postingan','user']))
            ->paginate(10)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function pending()
    {
        $user_id = auth()->user()->id;
        $no = 0;
        return view('kontributor.komentar.pending', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','pending')->where('user_id',$user_id)->latest()
            ->filter(request(['search','postingan','user']))
            ->paginate(10)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function ditolak()
    {
        $user_id = auth()->user()->id;
        $no = 0;
        return view('kontributor.komentar.ditolak', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','ditolak')->where('user_id',$user_id)->latest()
            ->filter(request(['search','postingan','user']))
            ->paginate(10)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi'           => 'required',
        ],
        [
            'isi.required'  => 'Isi Komentar Wajib di Isi',
        ]);
        
        $postingan_id= $request->postingan_id;

        $komen= Komentar::create(
            [
                'user_id'       => auth()->user()->id,
                'postingan_id'  => $request->postingan_id,
                'isi'           => $request->isi,
                'status'        => "pending",
            ]);

           $komentar = Komentar::where('id',$komen->id)->first();
           $postingan = Postingan::where('id',$postingan_id)->first();
           $like = Like::where('postingan_id',$postingan_id)->count();
           return view('show_postingan',[
                'postingan' => $postingan,
                'like'      => $like,
                'komentar'  => $komentar,
                
            ]);
    }

    public function show($id)
    {
        $data_komentar   = Komentar::find($id);
        $komentar = Komentar::with(['user','postingan'])->where('id',$id)->where('status','aktif')->first();
        return view('kontributor.komentar.show',[
            'postingan' => Postingan::with(['category','user'])->where('id',$data_komentar->postingan_id)->first(),
            'like'      => Like::where('postingan_id',$data_komentar->postingan_id)->count(),
            'komentar'         => $komentar,
            "category"         => Category::with(['postingan'])->get(),
        ]);
    }

    public function destroy($id)
    {
        $data_komentar   = Komentar::find($id);
        $data_komentar->delete();
        return redirect('/komentar/kontributor/ditolak')->with('pesan', 'Data berhasil di hapus');
    }


}
