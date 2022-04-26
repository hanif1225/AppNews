@extends('master.template')
@section('title','Tambah Data Pengguna')   
@section('content')   

    <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><i class="nav-icon fas fa-users"></i> <b>Form Tambah Data Pengguna</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('datapengguna.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">

                  <!-- row1 -->
                  <div class="form-group row">
                    <label for="name" class="ml-4 col-form-label">Nama</label>
                    <div class="col-sm-4">
                      <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Masukkan Nama" required>
                      <div class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>

                    <label for="username" class="ml-4 col-form-label">Username</label>
                    <div class="col-sm-4">
                      <input type="text" name="username" value="{{old('username')}}" class="form-control" id="username" placeholder="Masukan Username" required>
                      <div class="text-danger">
                        @error('username')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!-- row2 -->
                  <div class="form-group row">
                    <label for="email" class="ml-4 col-form-label">Email</label>
                    <div class="col-sm-4">
                      <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Masukkan Email" required>
                        <div class="text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>

                    <label for="no_hp" class="ml-4 col-form-label">No HP &nbsp</label>
                    <div class="col-sm-4">
                      <input type="text" name="no_hp" value="{{old('no_hp')}}" class="ml-4 form-control" id="no_hp" placeholder="Masukkan No HP" required>
                        <div class="text-danger">
                        @error('no_hp')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>
                  </div>
                  <!-- row4 -->
                  <div class="form-group row">
                    <label class="ml-4 col-form-label" >Level</label>
                    <select class="ml-2 form-select" name="level" required>
                        <option value="user">User</option>
                        <option value="kontributor">Kontributor</option>
                        <option value="editor">Editor</option>
                    </select>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="ml-4 col-form-label">Password</label>
                    <div class="col-sm-3">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                        <div class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>

                    <label for="cpassword" class="ml-4 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-3">
                      <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                  

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Simpan</button>
                  <a href="{{route('datapengguna')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection