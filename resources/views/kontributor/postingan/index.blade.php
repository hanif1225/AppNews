@extends('master.template')
@section('title','Berita Aktif')   
@section('content')  



@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

   <a href="{{route('postingan_kontributor_create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Berita</a>
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Berita Aktif</b></h3>

                <div class="card-tools">
                 <form action="/postingan/aktif/kontributor">
                  <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="search" value="{{request('search')}}" class="form-control float-right" placeholder="Masukkan Judul">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                 </form> 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Postingan</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Tanggal Publish</th>
                      <!-- <th>Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_postingan as $postingan)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$postingan->judul}}</td>
                      <td>{{$postingan->category->name}}</td>
                      <td>{{$postingan->status}}</td>
                      <td>{{\Carbon\Carbon::parse($postingan->updated_at)->format('d/m/Y')}}</td>
                      <td>
                        <!-- <a href="{{route('postingan_kontributor_show',$postingan->slug)}}" class="btn btn-sm btn-success"><i class="fas fa-search"></i> </a> -->
                      
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="d-flex justify-content-end mr-3">
                  {{$data_postingan->links()}}
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

@endsection