@extends('master.template')
@section('title','Draft Berita')   
@section('content')  

<!-- @if(session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
          {{session('pesan')}}
</div>
@endif -->

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- <a href="{{route('category.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Category</a> -->
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Draft Berita</b></h3>

                <div class="card-tools">
                 <form action="/postingan/draft/editor">
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
                        <!-- <a href="{{route('postingan_editor_show',$post->slug)}}" class="btn btn-sm btn-warning"><i class="fas fa-search"></i> </a> -->
                        <a href="{{route('proses_editing_editor',$post->slug)}}" class="btn btn-sm btn-primary" ><i class="fas fa-edit"></i></a>
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


@endsection