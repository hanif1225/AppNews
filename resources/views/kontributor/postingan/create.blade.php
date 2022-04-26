@extends('master.template')
@section('title','Tambah Berita')   
@section('content')   

    <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Tambah Berita</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('postingan_kontributor_store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group">
                    <label for="judul" class="ml-2 col-form-label">Judul</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('judul') is-invalid @enderror"  value="{{old('judul')}}" name="judul" id="judul" placeholder="Masukan Judul Postingan">
                      @error('judul')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                        <label class="ml-3 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="category_id">
                            @foreach($category as $category)
                              @if(old('category_id') == $category->id)
                              <option value="{{$category->id}}" selected>{{$category->name}}</option>
                              @else
                              <option value="{{$category->id}}" >{{$category->name}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        <label for="tanggal" class="ml-2 col-form-label">Tanggal Kejadian</label>
                         <div class="col-sm-3">
                          <input type="date" class="form-control @error('tanggal') is-invalid @enderror"  value="{{old('tanggal')}}"  name="tanggal" id="tanggal">
                          @error('tanggal')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                         </div>
                  </div>

                  <div class="form-group">
                    <label for="lokasi" class="ml-2 col-form-label">Lokasi Kejadian</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('lokasi') is-invalid @enderror"  name="lokasi" id="lokasi" placeholder="Masukan Lokasi Kejadian" >
                      @error('lokasi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar" class="ml-2 col-form-label">Gambar</label>
                    <div class="col-sm-4">
                    <img class="img-preview img-fluid">
                    <input type="file" name="gambar" id="gambar" class="form-control" onchange="previewImage()" >
                      <div class="text-danger">
                      @error('gambar')
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
                  <input type="submit" value="kirim" name="submit" class="btn btn-success">
                  <input type="submit" value="draft" name="submit" class="btn btn-dark">
                  <a href="{{route('postingan_kontributor')}}" class="btn btn-info float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
    
    <script>
        const judul = document.querySelector('#judul');
        const slug  = document.querySelector('#slug');

        judul.addEventListener('change', function(){
          fetch('/postingan/checkSlug/kontributor?judul=' + judul.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
        });

        function previewImage(){ 
        const gambar     = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');
        
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(gambar.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
        }
    </script>

@endsection