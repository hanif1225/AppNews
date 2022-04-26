@extends('master.template')
@section('title','Profile')   
@section('content')          

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Gagal !</h4>
          {{session('error')}}
</div>
@endif

<div class="col-md-6 container">
        <div class="card card-dark card-outline">
              <!-- card-body -->
              <h1 align="center" style="color:#212529"><b>Data  Afiliasi</b></h1>
            <div class="card-body box-profile">
                    <!-- contents of Data -->
                @foreach($data as $dt)
                <ul class="list-group list-group-unbordered mb-3 mt-2">
                  <li class="list-group-item">
                    <b style="color:#212529">Kode Afiliasi Pribadi</b> <a class="float-right">{{$dt->kode_afiliasi}}</a>
                  </li>
                    @if($dt->kode_undangan == null)
                    <a href="" class="btn  btn-primary" data-toggle="modal" data-target="#add-{{$dt->id}}"><b>Input Kode Undangan</b></a>
                    @endif
                </ul>
                @endforeach
                    <!-- end Data -->
            </div>
              <!-- /.card-body -->
        </div>
</div>

<div class="col-md-8 container">
        <div class="card card-dark card-outline">
              <!-- card-body -->
            <div class="card-body box-profile">
                    <!-- contents of Data -->
                <ul class="list-group list-group-unbordered mb-3 mt-2">
                  <li class="list-group-item">
                    - Lengkapi profil, maka anda akan mendapatkan kode afiliasi dan bisa menginput kode undangan
                  </li>
                  <li class="list-group-item">
                    - Input kode undangan dari kode afiliasi pengguna lain, maka anda akan mendapatkan point
                  </li>
                  <li class="list-group-item">
                    - Kirim kode afiliasi anda ke pengguna lain agar bisa mendapatkan point
                  </li>
                </ul>
            </div>
              <!-- /.card-body -->
        </div>
</div>

@foreach($data as $data)
    <!-- Add Afiliasi -->
    <div class="modal fade" id="add-{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-star"></i> <b>Kode Undangan</b></h5>
            <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form class="form" action="{{route('afiliasi_update_kontributor',$data->id)}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
            <label>Isi Kode</label>
            <input type="text" name="kode_undangan"  class="form-control">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success" >Kirim</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>
@endforeach
    <!-- End Modal -->

@endsection