@extends('master.template')
@section('title','Edit Category')   
@section('content')   

    <div class="col-md-8 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><i class="fas fa-clipboard"></i> <b>Form Tambah Data Category</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group row">
                    <label for="name" class="ml-4 col-form-label">Nama Kategori</label>
                    <div class="col-sm-4">
                      <input type="text" name="name" value="{{old('name',$category->name)}}" class="form-control" id="name" placeholder="Masukkan Nama" required>
                      <input type="text" name="name2" value="{{$category->name}}" class="form-control" id="name2" hidden required>
                      <div class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>

                    <label for="slug" class="ml-4 col-form-label">Slug</label>
                    <div class="col-sm-4">
                      <input type="text" name="slug" value="{{old('slug',$category->slug)}}" class="form-control" id="slug" placeholder="Masukkan Slug Kategori" required>
                      <input type="text" name="slug2" value="{{$category->slug}}" class="form-control" id="slug2" hidden required>
                        <div class="text-danger">
                        @error('slug')
                        {{ $message }}
                        @enderror
                        </div>
                    </div>

                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Update</button>
                  <a href="{{route('category')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection