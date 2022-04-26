@extends('master.template')
@section('title','Edit Iklan Adsense')   
@section('content')   

    <div class="col-md-8 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><i class="fas fa-clipboard"></i> <b>Form Tambah Data Category</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('update_iklan_ads',$data->id)}}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group ">
                    <label for="name" class="ml-2 col-form-label">Judul</label>
                    <div class="col-sm-4">
                      <input type="text" name="judul" value="{{old('judul',$data->judul)}}" class="form-control" id="name" placeholder="Masukkan Judul" required>
                      <div class="text-danger">
                        @error('judul')
                        {{ $message }}
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                    <label for="isi" class="ml-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                    <textarea class="textarea" placeholder="Silahkan Isi" name="isi" id="isi" value="{{old('isi')}}"
                            style="width: 100%; height: 200px; font-size: 14px; 
                                  line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                  {{$data->isi}}
                    </textarea>   
                    @error('isi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>

                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Update</button>
                  <a href="{{route('iklan_ads')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
@endsection