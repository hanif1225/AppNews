@extends('master.template')
@section('title','Edit Profile')   
@section('content')   

@if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Form Edit Profile</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('profile.update',$profil->id)}}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
                <div class="card-body">
                <!-- row1 -->
                <div class="form-group row">
                    <label for="nama" class="ml-4 col-form-label">Nama</label>
                    <div class="col-sm-4">
                      <input type="text" value="{{old('name',$user->name)}}" class="form-control" name="name" id="nama" placeholder="Masukan Nama" required>
                      @error('name')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <label for="email" class="ml-4 col-form-label">Email</label>
                    <div class="col-sm-4">
                      <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" id="email" placeholder="Masukan Email" required>
                        @error('email')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                <!-- row2 -->
                <div class="form-group row">
                    <label for="username" class="ml-4 col-form-label">Username</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" value="{{old('username',$user->username)}}"  name="username" id="username" placeholder="Masukan Username" required>
                      @error('username')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <label for="no_hp" class="ml-4 col-form-label">No HP</label>
                    <div class="col-sm-4">
                      <input type="text" value="{{old('no_hp',$user->no_hp)}}" name="no_hp" class="form-control" id="no_hp" placeholder="No HP" required>
                        @error('no_hp')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                  <!-- row3 -->
                  <div class="form-group row">
                    <label for="tanggal_lahir" class="ml-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-2">
                      <input id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir',$profil->tanggal_lahir)}}" type="date"   required>
                      @error('tanggal_lahir')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <label class="ml-4 input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" id="inputGroupSelect01" required>
                      <option selected>Pilih...</option>
                      @if($profil->jenis_kelamin == 'Laki-Laki')
                      <option value="Laki-Laki" selected>Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                      @else
                      <option value="Laki-Laki" >Laki-Laki</option>
                      <option value="Perempuan"selected>Perempuan</option>
                      @endif
                    </select>

                    <label for="instagram" class="ml-4 col-form-label">Instagram</label>
                    <div class="col-sm-3">
                      <input type="text" value="{{old('instagram',$profil->instagram)}}" name="instagram" class="form-control" id="instagram" placeholder="Nama Instagram" required>
                      @error('instagram')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <!-- row4 -->
                  <div class="form-group row">
                    <label for="rekening" class="ml-4 col-form-label">Nama Bank</label>
                    <div class="col-sm-4">
                      <input type="text" value="{{old('nama_rekening',$profil->nama_rekening)}}" name="nama_rekening" class="form-control" id="rekening" placeholder="Nama Rekening Bank" required>
                      @error('nama_rekening')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <label for="rekening2" class="ml-4 col-form-label">Nomor Rekening</label>
                    <div class="col-sm-4">
                      <input type="text" value="{{old('no_rekening',$profil->no_rekening)}}" name="no_rekening" class="form-control" id="rekening2" placeholder="Masukan Nomor Rekening" required>
                      @error('nama_rekening')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <!-- row5 -->
                  <div class="form-group row">
                    <label for="alamat" class="ml-4 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{old('alamat',$profil->alamat)}}"  name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>
                      @error('nama_rekening')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <!-- row6 -->
                  <div class="form-group row">
                      <label for="gambar" class="ml-4 col-form-label">Foto</label>
                      <div class="col-sm-5">
                        <input type="file" class="form-control-file"  id="gambar"  name="gambar" >
                        @error('gambar')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                        @enderror
                        <img src="{{ asset('foto/'.$profil->foto) }}" class="img-thumbnail" width="200px">
                        <input type="hidden" class="form-control-file" id="hidden_image"  name="hidden_image" value="{{$profil->foto}}">
                      </div>
                      <label for="gambar_ktp" class="ml-4 col-form-label">KTP</label>
                      <div class="col-sm-5">
                        <input type="file" class="form-control-file"  id="gambar_ktp"  name="gambar_ktp" >
                        @error('gambar_ktp')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                        @enderror
                        <img src="{{ asset('u_ktp/'.$profil->ktp) }}" class="img-thumbnail" width="200px">
                        <input type="hidden" class="form-control-file" id="hidden_ktp"  name="hidden_ktp" value="{{$profil->ktp}}">
                      </div>
                  </div>
                </div>

                <!-- row7 -->
                <label class="ml-3 col-form-label" style="color:red">Jika Ingin Mengubah Password Silahkan Isi Di Bawah Ini</label>
                <div class="form-group row">
                    <label for="password" class="ml-4 col-form-label">Password Baru</label>
                    <div class="col-sm-3">
                      <input type="password"  name="password" class="form-control" id="password" placeholder="Isikan Password">
                      @error('password')
                        <div class="invalid-feeedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <label for="cpassword" class="ml-4 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-3">
                      <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Konfirmasi Password">
                    </div>
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Simpan</button>
                  <a href="{{route('profile')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection