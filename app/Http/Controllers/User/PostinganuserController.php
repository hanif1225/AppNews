<?php

namespace App\Http\Controllers\User;


use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;
use File;


class PostinganuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $id= auth()->user()->id;

        $no = 0;
        return view('user.postingan.index', [
            "data_postingan" => Postingan::with(['category','user'])
                                ->where('status','aktif')
                                ->where('user_id',$id)->latest()
                                ->filter(request(['search','category','user']))
                                ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function draft()
    {
        $id = auth()->user()->id;
        $no = 0;
        return view('user.postingan.draft',[
            "data_postingan" => Postingan::with(['category','user'])
                                ->where('status','draft user')
                                ->where('user_id',$id)->latest()
                                ->filter(request(['search','category','user']))
                                ->paginate(20)->withQueryString(),
            "no"=>$no,
        ]);
    }

    public function pending()
    {
        $id= auth()->user()->id;
        $no = 0;
        
        return view('user.postingan.pending',[
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','pending')->where('user_id',$id)->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function tampil_editing()
    {
      $id= auth()->user()->id;
      $no = 0;
        return view('user.postingan.editing', [
            "data_postingan" => Postingan::with(['category','user'])
                ->where('user_id',$id)
                ->where('status','editing')
                ->orWhere('status','draft admin')
                ->orWhere('status','selesai')->latest()
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
        return view('user.postingan.create',[
            'category' => Category::all()
        ]);
    }


    public function reject()
    {
        $id= auth()->user()->id;
        $no = 0;

        return view('user.postingan.ditolak', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','ditolak')->where('user_id',$id)->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function perbaikan(Postingan $postingan)
    {
        return view('user.postingan.perbaikan',[
            'category' => Category::all(),
            'postingan' => $postingan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $button = $request->submit;
        if($button == 'kirim')
        {
            $status = 'pending'; 
        }
        elseif($button == 'draft')
        {
            $status = 'draft user';
        }
        
        $request->validate([
            'judul'         => 'required|unique:postingan|max:255',
            'category_id'   => 'required',
            'isi'           => 'required',
            'tanggal'       => 'required',
            'lokasi'        => 'required',
            'gambar'        => 'required|mimes:png,jpg,jpeg,svg|max:2500', 
        ],
        [
            'judul.required'         => 'Judul Wajib di Isi',
            'judul.max'              => 'Judul Maksimal 255 kata',
            'judul.unique'            => 'Judul Sudah Ada Yang Menggunakan Silahkan Gunakan Judul Lain',
            'category_id.required'   => 'Nama Kategori Wajib di Isi',
            'isi.required'           => 'Wajib di Isi',
            'gambar.required'        => 'Gambar wajib di isi!',
            'gambar.max'             => 'Maksimal ukuran gambar 2,5 MB',
            'gambar.mimes'           => 'Gambar wajib berformat PNG, JPG, JPEG dan SVG!', 
            'lokasi.required'        => 'Lokasi wajib di isi!',
            'tanggal.required'       => 'Tanggal Kejadian wajib di isi!',
        ]);

        $file = $request->file('gambar');
        $namafile = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('postingan'), $namafile);

        $excerpt = Str::limit(strip_tags($request->isi), 200);
        $views=0;
        $trending=0;
        $like=0;
        $user_id = auth()->user()->id;
        Postingan::create(
        [
            'user_id'       => $user_id,
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul),
            'category_id'   => $request->category_id,
            'isi'           => $request->isi,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'gambar'        => $namafile,
            'views'         => $views,
            'trending'      => $trending,
            'like'          => $like,
            'excerpt'       => $excerpt,
            'status'        => $status,
        ]);
        
        if($status == "pending")
        {
        return redirect('/postingan/pending')->with('pesan', 'Postingan Berhasil di Tambahkan Silahkan Tunggu Untuk Dilakukan Pengecekan Oleh Admin');
        }
        else
        {
            return redirect('/postingan/draft')->with('pesan', 'Postingan Berhasil di Simpan di Draft');
        }
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

        $like = Like::where('postingan_id',$postingan->id)->count();
         return view('user.postingan.show',[
             'postingan' => $postingan,
             'like'      => $like,
             'komentar'         => $komentar,
             'jumlah_komentar'  => $jumlah_komentar,
             "category"         => Category::with(['postingan'])->get(),
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
        return view('user.postingan.proses_edit',[
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
        $button = $request->submit;
        if($button == 'kirim')
        {
            $status = 'pending'; 
        }
        elseif($button == 'draft')
        {
            $status = 'draft user';
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
            'alasan'        => " ",
        );

        Postingan::find($postingan->id)->update($data);
        if($status == "pending")
        {
            return redirect('/postingan/pending')->with('pesan', 'Berhasil edit data silahkan tunggu beberapa hari untuk dilakukan pemrosesan');
        }
        else
        {
            return redirect('/postingan/draft')->with('pesan', 'Postingan di simpan di draft');
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

}
