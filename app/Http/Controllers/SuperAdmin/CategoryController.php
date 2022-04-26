<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Postingan;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $no=1;
        $data_category =  Category::with('postingan')->orderBy('id','desc')->get();
        return view('superadmin.category.index', compact('data_category','no'));
    }

    public function create()
    {
        return view('superadmin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
        ],
        [
            'name.required'        => 'Nama Category Wajib di Isi', 
        ]);

        Category::create(
            [
                'name'       => $request->name,
                'slug'       => Str::slug($request->name),
            ]);
            return redirect('category')->with('pesan', 'Data Berhasil Di Simpan');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('superadmin.category.edit',compact('category'));    
    }

    public function update(Request $request, $id)
    {
        if($request->name2 == $request->name && $request->slug2 == $request->slug)
        {
            
        }
        elseif($request->name2 == $request->name)
        {
            $request->validate([
                'slug' => 'required|unique:category',
            ],
            [
                'slug.required' => 'Slug Wajib di Isi',
            ]);
            $data= array(
                'slug'    =>  $request->slug,
            );
            Category::whereId($id)->update($data);
        }
        elseif($request->slug2 == $request->slug)
        {
            $request->validate([
                'name' => 'required|unique:category',
            ],
            [
                'name.required' => 'Nama Kategori Wajib di Isi',
            ]);
            $data= array(
                'name'    =>  $request->name,
            );
            Category::whereId($id)->update($data);
        }
        return redirect('category')->with('pesan', 'Berhasil edit data kategori');
    }

}
