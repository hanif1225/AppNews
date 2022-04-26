<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tentang;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.tentang.index', [
            "tentang" => Tentang::get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.tentang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
       
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
       
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
       
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
       
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
  
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
              
            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
    public function store(Request $request)
    {

        $tentang = Tentang::create([
            'isi' => $request->isi,
        ]);
        return redirect('/isi-tentang')->with('pesan', 'Postingan Berhasil di Tambahkan');
        // try{
        //         $input = $request->all();
        //         Tentang::updateOrCreate([
        //             'id' => $request->id,
        //         ],[
        //             'isi' => $input['isi'],
        //         ]);
        //             if($request->id)
        //             {
        //                 $msg = 'update successfully.';
        //             }
        //             else
        //             {
        //                 $msg = 'added successfully.';
        //             }
        //             $arr = array("status" => 200, "msg" =>$msg);
        //     } catch(\illuminate\Database\QueryException $ex){
        //         $msg = $ex->getMessage();
        //         if(isset($ex->errorInfo[2])) :
        //             $msg = $ex->errorInfo[2];
        //         endif;
        //         $arr=array("status" =>400,"msg" =>$msg, "result" =>array());
        //     }
        //     return \Response::json($arr);

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
        $tentang = Tentang::find($id);
        return view('superadmin.tentang.edit',compact('tentang'));
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
            $data= array(
                'isi'    =>  $request->isi,
            );
            Tentang::whereId($id)->update($data);

            return redirect('/isi-tentang')->with('pesan', 'Berhasil edit data tentang');
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
