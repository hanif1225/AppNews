@extends('master.template')
@section('title','Kelola Data Pengguna')   
@section('content')     

@if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
@endif

@if(session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
          {{session('pesan')}}
</div>
@endif

<a href="{{route('datapengguna.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Data Pengguna</a>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i><b> Kelola Data Pengguna</b></h3>

                <div class="card-tools">
                 <form action="/datapengguna" >
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
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>No HP</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_pengguna as $pengguna)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{ $pengguna->name }}</td>
                      <td>{{ $pengguna->username }}</td>
                      <td>{{ $pengguna->email }}</td>
                      <td>{{ $pengguna->no_hp }}</td>
                      <td>{{ $pengguna->level }}</td>
                      <td>
                      @if($pengguna->profil != null)
                      <a href="{{route('datapengguna.edit',$pengguna->profil->id)}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                      <a href="{{route('datapengguna.show',$pengguna->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-search"></i></a>
                        <form action="{{route('datapenggunaprofil.delete',$pengguna->profil->id)}}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah data ingin di hapus')"><i class="fas fa-trash"></i></button>
                        </form>
                      @else
                      <a href="{{route('datapengguna.createprofile',$pengguna->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i> </a>
                      <form action="{{route('datapengguna.delete',$pengguna->id)}}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah data ingin di hapus')"><i class="fas fa-trash"></i></button>
                      </form>
                      <!-- <a href="#" data-id="{{$pengguna->id}}" class="btn btn-sm btn-danger swal-confirm">
                      <form action="{{route('datapengguna.delete',$pengguna->id)}}" id="delete{{$pengguna->id}}" method="post">
                      @method('delete')
                      @csrf
                      </form>
                      <i class="fas fa-trash"></i>
                      </a> -->
                      @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="d-flex justify-content-end mr-3">
                  {{$data_pengguna->links()}}
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

@endsection