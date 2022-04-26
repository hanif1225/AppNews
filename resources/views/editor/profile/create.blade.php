@extends('master.template')
@section('title','Lengkapi Profile')   
@section('content')   

    <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Form Lengkapi Profile</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('profile.storeeditor')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group row">
                    <label for="tanggal" class="ml-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" value="{{old('tanggal_lahir')}}" name="tanggal_lahir" id="tanggal" placeholder="Masukan Tanggal Lahir" required>
                    </div>

                    <label class="ml-4 input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" id="inputGroupSelect01" required>
                      <option selected>Pilih...</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>

                    <label for="instagram" class="ml-4 col-form-label">Instagram</label>
                    <div class="col-sm-3">
                      <input type="text" name="instagram" value="{{old('instagram')}}" class="form-control" id="instagram" placeholder="Nama Instagram" required>
                      <div class="text-danger">
                        @error('instagram')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!-- row2 -->
                  <div class="form-group row">
                    <label for="rekening" class="ml-4 col-form-label">Nama Bank </label>
                    <div class="col-sm-4">
                      <input type="text" name="nama_rekening" value="{{old('nama_rekening')}}" class="form-control" id="rekening" placeholder="Nama Rekening Bank" required>
                      <div class="text-danger">
                        @error('nama_rekening')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>

                    <label for="rekening2" class="ml-4 col-form-label">Nomor Rekening</label>
                    <div class="col-sm-4">
                      <input type="text" name="no_rekening" value="{{old('no_rekening')}}" class="form-control" id="rekening2" placeholder="Masukan Nomor Rekening" required>
                      <div class="text-danger">
                        @error('no_rekening')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!-- row3 -->
                  <div class="form-group row">
                    <label for="alamat" class="ml-4 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" name="alamat" value="{{old('alamat')}}" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>
                        <div class="text-danger">
                        @error('alamat')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>
                  </div>
                  <!-- row4 -->
                  <div class="form-group row">
                    <label for="inputEmail3" class="ml-4 col-form-label">Foto</label>
                    <div class="col-sm-5">
                    <input type="file" name="foto" class="form-control" required>
                      <div class="text-danger">
                      @error('foto')
                      {{ $message }}
                      @enderror
                      </div>
                    </div>
                  
                    <label for="inputEmail3" class="ml-4 col-form-label">KTP</label>
                    <div class="col-sm-5">
                    <input type="file" name="ktp" class="form-control" required>
                    </div>
                      <div class="text-danger">
                        @error('ktp')
                        {{ $message }}
                        @enderror
                      </div>
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