<?php

namespace App\Http\Controllers\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;

class KomentareditorController extends Controller
{
    public function index()
    {
        
        $no = 0;
        return view('editor.komentar.index', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','aktif')->latest()
            ->filter(request(['search','postingan','user']))
            ->paginate(10)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function pending()
    {
        $no = 0;
        return view('editor.komentar.pending', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','pending')->latest()
            ->filter(request(['search','postingan','user']))
            ->paginate(10)->withQueryString(),
            "no" => $no,
        ]);
    }
    public function ditolak()
    {
        $no = 0;
        return view('editor.komentar.ditolak', [
            "komentar" => Komentar::with(['postingan','user'])
            ->where('status','ditolak')->latest()
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
    public function update(Request $request, $id)
    {
            Komentar::where('id',$id)->update([
                'status' => "aktif",
            ]);
            return redirect('/editorkomentar')->with('pesan', 'Komentar Berhasil di Aktifkan');
    }

    public function rejected(Request $request, $id)
    {
        $data= array(
            'status'    =>  "ditolak",
            'alasan'    =>  $request->alasan,
        );
        Komentar::where('id', $id)->update($data);

        return redirect('/editorkomentar/ditolak')->with('pesan', 'Data Komentar Berhasil Ditolak');
        
    }
    public function alasan($id)
    {
        return view('editor.komentar.alasan',[


            'komentar' => Komentar::where('id', $id)->first(),
        ]);
    }

    public function destroy($id)
    {
        $data_komentar   = Komentar::find($id);
        $data_komentar->delete();
        return redirect('/editorkomentar/ditolak')->with('pesan', 'Data berhasil di hapus');
    }

    public function show($id)
    {
        $data_komentar   = Komentar::find($id);
        $komentar = Komentar::with(['user','postingan'])->where('id',$id)->where('status','aktif')->first();
        return view('editor.komentar.show',[
            'postingan' => Postingan::with(['category','user'])->where('id',$data_komentar->postingan_id)->first(),
            'like'      => Like::where('postingan_id',$data_komentar->postingan_id)->count(),
            'komentar'         => $komentar,
            "category"         => Category::with(['postingan'])->get(),
        ]);

    }
}
