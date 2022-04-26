<?php

namespace App\Http\Controllers\Editor;

use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Komentar;
use App\Models\Like;
use App\Models\Category;
use App\Models\Reward;
use App\Models\History_Reward;
use File;

class PostinganeditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $no = 0;
        return view('editor.postingan.index', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','aktif')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);

    }

    public function pending()
    {
        $no = 0;
        return view('editor.postingan.pending', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','pending')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);

    }

    public function draft()
    {
        $no = 0;
        return view('editor.postingan.draft', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','draft admin')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function menampilkan()
    {
        $no = 0;
        return view('editor.postingan.edit', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','editing')->orWhere('status','selesai')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function reject()
    {
        $no = 0;
        return view('editor.postingan.ditolak', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','ditolak')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);

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
    public function show(Postingan $postingan)
    {
        $komentar = Komentar::where('postingan_id',$postingan->id)->where('status','aktif')->with(['user','postingan'])->get();
        $jumlah_komentar = Komentar::where('postingan_id',$postingan->id)->where('status','aktif')->count();
        $views = Postingan::where('id',$postingan->id)->increment('views');
        $like = Like::where('postingan_id',$postingan->id)->count();
        return view('editor.postingan.show',[
            'postingan' => $postingan,
            'like'      => $like,
            'komentar'         => $komentar,
            'jumlah_komentar'  => $jumlah_komentar,
            "category"         => Category::with(['postingan'])->get(),
        ]);
    }

    public function alasan(Postingan $postingan)
    {
        return view('editor.postingan.alasan',[
            'postingan' => $postingan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Postingan $postingan)
    {
        return view('editor.postingan.edit_aktif',[
            'category' => Category::all(),
            'postingan' => $postingan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postingan $postingan)
    {

        
        // Cek Judul
        if($postingan->judul == $request->judul)
        {
            $request->validate([
                'judul' => 'required|max:255',
            ],
            [
                'judul.required' => 'Judul Wajib di Isi',
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        else
        {
            $request->validate([
                'judul' => 'required|unique:postingan|max:255',
            ],
            [
                'judul.required' => 'Judul Wajib di Isi',
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        
        //cek gambar
        $old_image_name = $request->hidden_gambar;
        $image          = $request->file('gambar');
        if($image != '')
        {
            $request->validate([
            'gambar'        => 'required|mimes:png,jpg,jpeg,svg|max:2500',
            ],
            [
            'gambar.required'        => 'Gambar wajib di isi!',
            'gambar.max'             => 'Maksimal ukuran gambar 2,5 MB',
            'gambar.mimes'           => 'Gambar wajib berformat PNG, JPG, JPEG dan SVG!', 
            ]);

            $image_name=$old_image_name;
            $image->move(public_path('postingan'),$image_name);
        }
        else
        {
            $image_name=$old_image_name;
        }
        
        //cek data yang belum
        $request->validate([
            'category_id'   => 'required',
            'isi'           => 'required',
            'tanggal'       => 'required',
            'lokasi'        => 'required',
        ],
        [
            'category_id.required'   => 'Nama Kategori Wajib di Isi',
            'isi.required'           => 'Wajib di Isi', 
            'lokasi.required'        => 'Lokasi wajib di isi!',
            'tanggal.required'       => 'Tanggal Kejadian wajib di isi!',
        ]);
        
        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 200);

        $data= array(
            'user_id'       => $postingan->user_id,
            'judul'         => $judul,
            'slug'          => Str::slug($request->judul),
            'category_id'   => $request->category_id,
            'isi'           => $request->isi,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'gambar'        => $image_name,
            'status'        => "aktif",
        );

        Postingan::find($postingan->id)->update($data);
        return redirect('/postingan/aktif/editor')->with('pesan', 'Data Berhasil Di Update ');
    }

    public function publish(Request $request, Postingan $postingan)
    {
        $data= array(
            'status'    =>  "aktif",
        );
        Postingan::where('id', $postingan->id)->update($data);

        $reward = Reward::where('user_id',$postingan->user_id)->first();

        if($reward)
        {
            $data_point   = $request->point;
            $data_reward  = $reward->point;
            $hasil_reward = $data_reward + $data_point;
            $tanggal        = date("Y-m-d");
            $data= array(
             'point'           =>$hasil_reward ,
            );

            Reward::where('user_id',$postingan->user_id)->update($data);
            
            History_Reward::create([
                'user_id'      => $postingan->user_id,
                'point'        => $request->point,
                'aktivitas'    => "Artikel ".$postingan->judul." telah publish",
                'tanggal'      => $tanggal,
            ]);

        }
        else
        {
            $tanggal        = date("Y-m-d");
            
            $hasil= Reward::create([
                'user_id'      => $postingan->user_id,
                'point'        => $request->point
            ]);

            History_Reward::create([
                'user_id'      => $postingan->user_id,
                'point'        => $request->point,
                'aktivitas'    => "Artikel ".$postingan->judul." telah publish",
                'tanggal'      => $tanggal,
            ]);
        }

        return redirect('/postingan/aktif/editor')->with('pesan', 'Data Berhasil Di Update ');
        
    }

    
    public function editing(Request $request, Postingan $postingan)
    {
        $data= array(
            'status'    =>  "editing",
        );
        Postingan::where('id', $postingan->id)->update($data);

        return redirect('/post/edit/editor')->with('pesan', 'Data Berhasil Di Pindahkan Ke Editing');
        
    }

    public function rejected(Request $request, Postingan $postingan)
    {
        $validateData['excerpt'] = Str::limit(strip_tags($request->alasan), 200);

        $data= array(
            'status'    =>  "ditolak",
            'alasan'    =>  $request->alasan,
        );
        Postingan::where('id', $postingan->id)->update($data);

        return redirect('/postingan/reject/editor')->with('pesan', 'Data Berhasil Di Update ');
        
    }

    public function proses_editing(Postingan $postingan)
    {
        return view('editor.postingan.proses_editing',[
            'category' => Category::all(),
            'postingan' => $postingan,
        ]);
    }

    public function update_editing(Request $request, Postingan $postingan)
    {
        $button = $request->submit;
        if($button == 'kirim')
        {
            $status = 'selesai'; 
        }
        elseif($button == 'draft')
        {
            $status = 'draft admin';
        }
        
        // Cek Judul
        if($postingan->judul == $request->judul)
        {
            $request->validate([
                'judul' => 'required|max:255',
            ],
            [
                'judul.required' => 'Judul Wajib di Isi',
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        else
        {
            $request->validate([
                'judul' => 'required|unique:postingan|max:255',
            ],
            [
                'judul.required' => 'Judul Wajib di Isi',
                'judul.max'      => 'Judul Maksimal 255 kata',
            ]);
            // hasil data 
            $judul = $request->judul;
        }
        
        //cek gambar
        $old_image_name = $request->hidden_gambar;
        $image          = $request->file('gambar');
        if($image != '')
        {
            $request->validate([
            'gambar'        => 'required|mimes:png,jpg,jpeg,svg|max:2500',
            ],
            [
            'gambar.required'        => 'Gambar wajib di isi!',
            'gambar.max'             => 'Maksimal ukuran gambar 2,5 MB',
            'gambar.mimes'           => 'Gambar wajib berformat PNG, JPG, JPEG dan SVG!', 
            ]);

            $image_name=$old_image_name;
            $image->move(public_path('postingan'),$image_name);
        }
        else
        {
            $image_name=$old_image_name;
        }
        
        //cek data yang belum
        $request->validate([
            'category_id'   => 'required',
            'isi'           => 'required',
            'tanggal'       => 'required',
            'lokasi'        => 'required',
        ],
        [
            'category_id.required'   => 'Nama Kategori Wajib di Isi',
            'isi.required'           => 'Wajib di Isi', 
            'lokasi.required'        => 'Lokasi wajib di isi!',
            'tanggal.required'       => 'Tanggal Kejadian wajib di isi!',
        ]);
        
        $validateData['excerpt'] = Str::limit(strip_tags($request->isi), 200);

        $data= array(
            'user_id'       => $postingan->user_id,
            'judul'         => $judul,
            'slug'          => Str::slug($request->judul),
            'category_id'   => $request->category_id,
            'isi'           => $request->isi,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'gambar'        => $image_name,
            'status'        => $status,
        );

        Postingan::find($postingan->id)->update($data);

        if($status == 'selesai')
        {
        return redirect('/post/edit/editor')->with('pesan', 'Data Berhasil Di Update ');
        }
        else
        {
        return redirect('/postingan/draft/editor')->with('pesan', 'Data Berhasil Di Update ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postingan $postingan)
    {
        $data_posting = Postingan::find($postingan->id);

        File::delete('postingan/'.$data_posting->gambar);
        $data_posting->delete();
        return redirect()->back()->with('pesan', 'Data berhasil di hapus');
    }

    public function checkSlug(Request  $request)
    {
        $slug = SlugService::createSlug(Postingan::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
