@extends('master.template')
@section('title','Tambah Category')   
@section('content')   

    <div class="col-md-8 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><i class="fas fa-clipboard"></i> <b>Form Tambah Data Category</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group row">
                    <label for="name" class="ml-4 col-form-label">Nama Kategori</label>
                    <div class="col-sm-4">
                      <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Masukkan Nama" required>
                      <div class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>



                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Simpan</button>
                  <a href="{{route('category')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection