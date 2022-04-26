@extends('master.template')
@section('title','Data Iklan')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Postingan Aktif</b></h3>

                <div class="card-tools">
                  <form action="/iklan" >
                    <div class="input-group input-group-sm" >
                      <input type="text" name="category" value="{{request('category')}}" class="form-control float-right ml-2" placeholder="Masukkan Kategori">
                      <input type="text" name="user" value="{{request('user')}}" class="form-control float-right ml-2" placeholder="Masukkan Penulis">
                      <input type="text" name="search" value="{{request('search')}}" class="form-control float-right ml-2" placeholder="Masukkan Judul">
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
                      <th>Penulis</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_postingan as $postingan)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$postingan->judul}}</td>
                      <td>{{$postingan->user->name}}</td>
                      <td>{{$postingan->category->name}}</td>
                      <td>{{$postingan->status}}</td>
                      <td>
                        @if($postingan->iklan == null)
                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-{{$postingan->id}}">Aktivasi Iklan </a>
                        @endif
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


<!-- iklan -->
<div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Iklan</b></h3>

                <div class="card-tools">
                  <form action="/iklan" >
                    <div class="input-group input-group-sm" >
                      <input type="text" name="pengguna" value="{{request('pengguna')}}" class="form-control float-right ml-2" placeholder="Masukkan Penulis">
                      <input type="text" name="postingan" value="{{request('postingan')}}" class="form-control float-right ml-2" placeholder="Masukkan Judul">
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
                      <th>Penulis</th>
                      <th>Kategori</th>
                      <th>Tanggal Aktif Iklan</th>
                      <th>Tanggal Berakhir Iklan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($iklan as $dt_iklan)
                    <tr>
                      <td>{{++$no2}}</td>
                      <td>{{$dt_iklan->postingan->judul}}</td>
                      <td>{{$dt_iklan->user->name}}</td>
                      <td>{{$dt_iklan->postingan->category->name}}</td>
                      <td>{{\Carbon\Carbon::parse($dt_iklan->tanggal_mulai)->format('d/m/Y')}}</td>
                      <td>{{\Carbon\Carbon::parse($dt_iklan->tanggal_berakhir)->format('d/m/Y')}}</td>
                      <td>
                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#perpanjangan-{{$dt_iklan->id}}">Perpanjang Iklan </a>
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
<!-- end iklan -->

<!-- Modal Aktivasi Iklan -->
@foreach($data_postingan as $post)
<!-- ADD -->
<div class="modal fade" id="add-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ad"></i> <b>Aktivasi Iklan</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('kirim_iklan')}}" method="post" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="user_id"  value="{{$post->user_id}}"  class="form-control">

          <input type="hidden" name="postingan_id"  value="{{$post->id}}"  class="form-control">

        <div class="form-group">
          <label>Tanggal Aktivasi Iklan</label>
          <input type="date" name="tanggal_mulai" class="form-control">
        </div>

        <div class="form-group">
          <label>Tanggal Berakhir Aktivasi Iklan</label>
          <input type="date" name="tanggal_berakhir" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Modal -->

<!-- Modal Perpanjangan Iklan -->
@foreach($iklan as $ik)
<!-- ADD -->
<div class="modal fade" id="perpanjangan-{{$ik->id}}" tabindex="-1" role="dialog" aria-labelledby="perpanjangan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ad"></i> <b>Aktivasi Iklan</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('update_iklan',$ik->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="form-group">
          <label>Tanggal Aktivasi Iklan</label>
          <input type="date" name="tanggal_mulai" value="{{$ik->tanggal_mulai}}" class="form-control">
        </div>

        <div class="form-group">
          <label>Tanggal Berakhir Aktivasi Iklan</label>
          <input type="date" name="tanggal_berakhir" value="{{$ik->tanggal_berakhir}}" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Modal -->

@endsection
