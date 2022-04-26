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
use App\Models\Reward;
use App\Models\History_Reward;
use App\Models\Like;
use App\Models\Category;
use App\Models\Komentar;
use File;

class PostinganadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $postingan = Postingan::with(['category','user'])->where('status','aktif')->latest();
        
        $no = 0;
        return view('superadmin.postingan.index', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','aktif')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }
    
    public function tampil_editing()
    {
      $no = 0;
        return view('superadmin.postingan.editing', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','editing')->orWhere('status','selesai')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function pending()
    {
        $no = 0;
        return view('superadmin.postingan.pending', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','pending')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function ditolak()
    {
        $no = 0;
        return view('superadmin.postingan.ditolak', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','ditolak')->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }
    public function draft()
    {
        $no = 0;
        return view('superadmin.postingan.draft', [
            "data_postingan" => Postingan::with(['category','user'])
            ->where('status','draft admin')
            ->latest()
            ->filter(request(['search','category','user']))
            ->paginate(20)->withQueryString(),
            "no" => $no,
        ]);
    }

    public function proses_editing(Postingan $postingan)
    {
        return view('superadmin.postingan.proses_editing',[
            'category' => Category::all(),
            'postingan' => $postingan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.postingan.create',[
            'category' => Category::all()
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
            $status = 'aktif'; 
        }
        elseif($button == 'draft')
        {
            $status = 'draft admin';
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

        $user_id = auth()->user()->id;
        $views=0;
        $trending=0;
        $like=0;
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
        
        if($status == "aktif")
        {
        return redirect('/admpostingan')->with('pesan', 'Postingan Berhasil di Tambahkan');
        }
        else
        {
        return redirect('/admpostingan/draft')->with('pesan', 'Postingan Berhasil di Simpan di Draft');
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
        
        return view('superadmin.postingan.show',[
            'postingan'        => $postingan,
            'like'             => $like,
            'komentar'         => $komentar,
            'jumlah_komentar'  => $jumlah_komentar,
            "category"         => Category::with(['postingan'])->get(),
        ]);
    }

    public function alasan(Postingan $postingan)
    {
        return view('superadmin.postingan.alasan',[
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
        return view('superadmin.postingan.edit_aktif',[
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

        return redirect('/admpostingan')->with('pesan', 'Data Berhasil Di Update ');
        
    }

    public function rejected(Request $request, Postingan $postingan)
    {


        $data= array(
            'status'    =>  "ditolak",
            'alasan'    =>  strip_tags($request->alasan),
        );
        Postingan::where('id', $postingan->id)->update($data);

        return redirect('/admpostingan/ditolak')->with('pesan', 'Data Berhasil Di Update ');
        
    }

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
        return redirect('admpostingan')->with('pesan', 'Data Berhasil Di Update ');

    }

    public function update_editing(Request $request, Postingan $postingan)
    {
        $button = $request->submit;
        if($button == 'kirim')
        {
            if($postingan->user_id == 3)
            {
                $status = 'aktif';    
            }
            else
            {
            $status = 'selesai';
            } 
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
        if($status == "aktif")
        {
            return redirect('/admpostingan')->with('pesan', 'Data berhasil di update ');
        }
        elseif($status == 'selesai')
        {
        return redirect('/admpostingan/editing')->with('pesan', 'Data berhasil di update ');
        }
        else
        {
        return redirect('/admpostingan/draft')->with('pesan', 'Data berhasil di simpan di draft ');
        }
    }

    public function editing(Request $request, Postingan $postingan)
    {
        $data= array(
            'status'    =>  "editing",
        );
        Postingan::where('id', $postingan->id)->update($data);

        return redirect('/admpostingan/editing')->with('pesan', 'Data Berhasil Di Pindahkan Ke Editing');
        
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
