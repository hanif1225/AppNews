@extends('master.template')
@section('title','Editing Berita')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- <a href="{{route('category.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Category</a> -->
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Editing Berita</b></h3>

                <div class="card-tools">
                 <form action="/admpostingan/editing">
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
                        <!-- <a href="{{route('postingan_show_adm',$post->slug)}}" class="btn btn-sm btn-warning"><i class="fas fa-search"></i> </a> -->
                        <a href="{{route('proses_editing_adm',$post->slug)}}" class="btn btn-sm btn-primary" ><i class="fas fa-edit"></i></a>
                        @if($post->status == 'selesai')
                          <a href="" data-toggle="modal" data-target="#add-{{$post->id}}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                          <a href="{{route('postingan_alasan_adm',$post->slug)}}" class="btn btn-sm btn-danger" ><i class="fas fa-times"></i></a>
                          @endif
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
<div class="modal fade" id="add-{{$postingan->id}}" tabindex="-1" role="dialog" aria-labelledby="perpanjangan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-id-badge"></i> <b>Publish Postingan</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('postingan_publish_adm',$postingan->slug)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label>Point</label>
          <input type="number" name="point" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Kirim</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
@endforeach


@endsection