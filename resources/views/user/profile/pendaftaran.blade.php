@extends('master.template')
@section('title','Pendaftaran')   
@section('content')   

@if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="col-md-6 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Form Pegajuan</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('pendaftaran.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                <!-- row1 -->
                    <div class="form-group row ml-5">
                        <label for="nama" class="ml-4 col-form-label">Kode Akses</label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="kode_akses" id="nama" placeholder="Masukan Kode Akses" required>
                        </div>
                    </div>
                    <div class="form-group row ml-5">
                    <label class="ml-4 input-group-text" for="inputGroupSelect01">Daftar Sebagai</label>
                    <select class="form-select" name="permintaan" id="inputGroupSelect01" required>
                      <option selected>Pilih...</option>
                      <option value="kontributor">Kontributor</option>
                      <option value="editor">Editor</option>
                    </select>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">Ajukan</button>
                        <a href="{{route('profile')}}" class="btn btn-default float-right">Cancel</a>
                    </div>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection