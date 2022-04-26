@extends('master.template')
@section('title','Tambah Iklan')   
@section('content')   

    <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Tambah Iklan</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('iklan_ads_tambah')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group">
                    <label for="judul" class="ml-2 col-form-label">Judul</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('judul') is-invalid @enderror"  value="{{old('judul')}}" name="judul" id="judul" placeholder="Masukan Judul">
                      @error('judul')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="isi" class="ml-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                    <textarea class="textarea" placeholder="Silahkan Isi" name="isi" id="isi" value="{{old('isi')}}"
                            style="width: 100%; height: 200px; font-size: 14px; 
                                  line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    </textarea>  
                    @error('isi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                  <a href="{{route('iklan_ads')}}" class="btn btn-info float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
    


@endsection