@extends('master.template')
@section('title','Pending Berita')   
@section('content')  



@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- <a href="{{route('category.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Category</a> -->
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Pending Berita</b></h3>

                <div class="card-tools">
                 <form action="/postingan/pending/editor">
                  <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" value="{{request('search')}}" class="form-control float-right" placeholder="Masukkan Judul">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                 </form> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Postingan</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_postingan as $post)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$post->judul}}</td>
                      <td>{{$post->category->name}}</td>
                      <td>{{$post->status}}</td>
                      <td>
                        <!-- <a href="{{route('postingan_editor_show',$post->slug)}}" class="btn btn-sm btn-success"><i class="fas fa-search"></i> </a> -->
                        <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editing-{{$post->id}}"><i class="fas fa-edit"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="d-flex justify-content-end mr-3">
                  {{$data_postingan->links()}}
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

<!-- edit -->
@foreach($data_postingan as $postingan)
<div class="modal fade" id="editing-{{$postingan->id}}" tabindex="-1" role="dialog" aria-labelledby="perpanjangan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form class="form" action="{{route('postingan_editor_editing',$postingan->slug)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <h5 align="center"> <b>Pindahkan Ke Editing</b></h5>  
        <hr>
          <center>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-success" >Iya</button>
          </center>
       </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
@endforeach


@endsection