@extends('master.template')
@section('title','Hak Akses')   
@section('content')  

@if(session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
          {{session('pesan')}}
</div>
@endif

<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#add"><i class="far fa-plus-square"></i> Tambah Hak Akses</a>
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-user-cog"></i> <b>Data Hak Akses</b></h3>

                <div class="card-tools">
                 <form action="/akses">
                  <div class="input-group input-group-sm" style="width: 150px;">
                   <input type="text" name="search" value="{{request('search')}}" class="form-control float-right" placeholder="Masukkan Nama">

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
                      <th>Nama</th>
                      <th>Kode Akses</th>
                      <th>Permintaan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_permintaan as $permintaan)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$permintaan->user->name}}</td>
                      <td>{{$permintaan->kode_akses}}</td>
                      <td>{{$permintaan->permintaan}}</td>
                      <td>{{$permintaan->status}}</td>
                      <td>
                        <form action="{{route('akses_delete',$permintaan->id)}}" method="post" class="d-inline">
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
                  {{$data_permintaan->links()}}
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

<!-- ADD -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-cog"></i> <b>Tambah Hak Akses</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('akses.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Id User Yang Diberikan Hak Akses</label>
          <input type="number" name="user_id"   class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kode Akses</label>
          <input type="text" name="kode_akses" value="{{$output_random}}"  class="form-control" required>
        </div>

        <div class="form-group">
          <label>Permintaan</label>
          <select class="form-select" name="permintaan" required>
            <option value="kontributor">Kontributor</option>
            <option value="editor">Editor</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

@endsection