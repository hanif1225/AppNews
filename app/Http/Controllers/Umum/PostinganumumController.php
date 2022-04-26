<?php

namespace App\Http\Controllers\Umum;

use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profil_user;
use App\Models\User;
use App\Models\Like;
use App\Models\Postingan;
use App\Models\Komentar;
use App\Models\History;
use App\Models\Category;
use App\Models\Tentang;
use App\Models\Iklan;
use App\Models\Kontak;
use App\Models\Statistik;
use App\Models\Kebijakan;
use DB;
use Carbon\Carbon;
use File;

class PostinganumumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $now= date('y');
        return view('master.index2', [
            "postingan" => Postingan::with(['category','user'])
            ->where('status','aktif')->latest('updated_at')
            ->filter(request(['search','category','user']))
            ->paginate(5)->withQueryString(),

            "postingan_trending"=> Postingan::with(['category','user'])
                                    ->where('status','aktif')
                                    ->whereYear('tanggal',2021)
                                    ->limit(5)->orderBy('trending','desc')->get(),

            "postingan_like"=> Postingan::with(['category','user'])
                                    ->where('status','aktif')
                                    ->limit(3)->orderBy('like','desc')->get(),

            "postingan_views"=> Postingan::with(['category','user'])
                                    ->where('status','aktif')
                                    ->limit(3)->orderBy('views','desc')->get(),

            "category"          => Category::with(['postingan'])->get(),
            "data_like"         => Like::get(),
            "data_komentar"     => Komentar::get(),
            "no"                => $no=0,
      

        ]);
    }

    public function trending()
    {
     
        
        return view('master.index2', [
            "postingan" => Postingan::with(['category','user'])
            ->where('status','aktif')->latest('updated_at')
            ->filter(request(['search','category','user']))
            ->limit(5)->withQueryString(),

            "category"       => Category::with(['postingan'])->get(),
            "data_like"      => Like::get(),
            "data_komentar"  => Komentar::get(),
      

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
        $komentar = Komentar::where('postingan_id',$postingan->id)->where('status','aktif')->get();
        $jumlah_komentar = Komentar::where('postingan_id',$postingan->id)->where('status','aktif')->count();
        $views = Postingan::where('id',$postingan->id)->increment('views');
        $trending = Postingan::where('id',$postingan->id)->increment('trending');
        $tanggal        = date("Y-m-d");

        //tambah statistik
        Statistik::create(
            [
                'user_id'           => $postingan->user_id,
                'status_iklan'      => $postingan->iklan,
                'tanggal'           => $tanggal,
                'judul'             => $postingan->judul,
                'postingan_id'      => $postingan->id,
            ]);

        //mengecek ada user atau tidak
        if(auth()->user() == null)
        {
        
        }
        elseif(auth()->user() != " ")
        {
            
            //penghitungan history
            $j_history = History::where('user_id',auth()->user()->id)->count();
            if($j_history > 3)
            {
                $cek_history= History::where('user_id',auth()->user()->id)->min('id');
                $data_posting = History::where('id',$cek_history)->delete();
            }
            $history = History::where('postingan_id',$postingan->id)->where('user_id',auth()->user()->id)->first();
            
            if($history)
            {

            }
            else
            {
                History::create(
                    [
                        'user_id'       => auth()->user()->id,
                        'postingan_id'  => $postingan->id,
                        'slug'          => $postingan->slug,
                    ]);
            }
        }

        // menghapus iklan
        $data= array(
            'iklan'    =>  null,
        );

        $iklan = Iklan::where('tanggal_berakhir',$tanggal)->first();
        if($iklan != null)
        {
            $iklan->delete();
            Postingan::find($iklan->postingan_id)->update($data);
        }
        

        $like = Like::where('postingan_id',$postingan->id)->count();
        return view('show',[
            'postingan'        => $postingan,
            'like'             => $like,
            'komentar'         => $komentar,
            'jumlah_komentar'  => $jumlah_komentar,
            "category"         => Category::with(['postingan'])->get(),
            
        ]);
        
    }

    public function show_category(Category $category)
    {
        return view('show_kategori',[
            "postingan"     => Postingan::with(['category','user'])
                                ->where('status','aktif')->where('category_id',$category->id)->latest('updated_at')
                                ->filter(request(['search','category','user']))
                                ->paginate(5)->withQueryString(),
            "category"      => Category::with(['postingan'])->get(),
            "title"         => $category->name,
        ]);
    }
    public function tentang()
    {
        return view('about', [
            "tentang" => Tentang::get()
        ]);
    }

    public function isi_tentang()
    {
        return view('isi_about', [
            "tentang" => Tentang::get()
        ]);
    }

    public function kebijakan()
    {
        return view('kebijakan', [
            "kebijakan" => Kebijakan::get()
        ]);
    }

    public function isi_kebijakan()
    {
        return view('isi_kebijakan', [
            "kebijakan" => Kebijakan::get()
        ]);
    }

    public function bantuan()
    {


        return view('bantuan',[
            "bantuan" => Kontak::get()
        ]);
    }

    public function isi_bantuan()
    {


        return view('isi_bantuan',[
            "bantuan" => Kontak::get()
        ]);
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

    public function checkSlug(Request  $request)
    {
        $slug = SlugService::createSlug(Postingan::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
