@extends('master.template')
@section('title','Komentar Ditolak')   
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
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Komentar Ditolak</b></h3>

                <div class="card-tools">
                  <form action="/komentar/kontributor/ditolak" >
                    <div class="input-group input-group-sm" >
                      <input type="text" name="postingan" value="{{request('postingan')}}" class="form-control float-right mr-2" placeholder="Judul Postingan">
                      <input type="text" name="user" value="{{request('user')}}" class="form-control float-right mr-2" placeholder="Nama user">
                      <input type="text" name="search" value="{{request('search')}}" class="form-control float-right mr-2" placeholder="Isi Komentar">
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
                      <th>Isi Komentar</th>
                      <th>Alasan Ditolak</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($komentar as $komen)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$komen->postingan->judul}}</td>
                      <td>{{$komen->isi}}</td>
                      <td>{{$komen->alasan}}</td>
                      <td>
                        <form action="{{route('komentar_delete_kontributor',$komen->id)}}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah data ingin di hapus')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="d-flex justify-content-end mr-3">
                {{$komentar->links()}}
                </div>
            </div>
            <!-- /.card -->

          </div>

        </div>



@endsection