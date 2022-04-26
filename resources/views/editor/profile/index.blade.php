@extends('master.template')
@section('title','Profile')   
@section('content')          

@if(session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
          {{session('pesan')}}
</div>
@endif

<div class="col-md-6 container">
            <div class="card card-dark card-outline">
              <!-- card-body -->
              <h1 align="center" style="color:#212529"><b>Profile</b></h1>
              <div class="card-body box-profile">
                <div class="text-center">
                @if($user->profil == null)
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('foto')}}/user.png"
                       alt="User profile picture" >
                @else
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('foto')}}/{{$user->profil->foto}}"
                       alt="User profile picture" >
                @endif
                </div>
          <!-- contents of profile -->
          @if($user->profil == null)
              <ul class="list-group list-group-unbordered mb-3 mt-2">
                  <li class="list-group-item">
                    <b style="color:#212529">Nama</b> <a class="float-right">{{ $user->name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Email</b> <a class="float-right">{{ $user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Username</b> <a class="float-right">{{ $user->username}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">No Hp</b> <a class="float-right">{{$user->no_hp}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Tanggal Lahir</b> <a class="float-right">Kosong</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Jenis Kelamin</b> <a class="float-right">Kosong</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Instagram</b> <a class="float-right">Kosong</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">No Rekening</b> <a class="float-right">Kosong</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">KTP</b> <a class="float-right">Kosong</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Alamat</b> <a class="float-right">Kosong</a>
                  </li>
                  
                </ul>
                <a href="{{route('profile.createeditor')}}" class="btn btn-primary btn-block"><b>Lengkapi Profile</b></a>
              @else

                <ul class="list-group list-group-unbordered mb-3 mt-2">
                  <li class="list-group-item">
                    <b style="color:#212529">Nama</b> <a class="float-right">{{ $user->name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Email</b> <a class="float-right">{{ $user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Username</b> <a class="float-right">{{ $user->username}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">No Hp</b> <a class="float-right">{{$user->no_hp}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Tanggal Lahir</b> <a class="float-right">{{\Carbon\Carbon::parse($user->profil->tanggal_lahir)->format('d/m/Y')}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Jenis Kelamin</b> <a class="float-right">{{$user->profil->jenis_kelamin}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Instagram</b> <a class="float-right">{{$user->profil->instagram}}</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">No Rekening</b> <a class="float-right">{{$user->profil->nama_rekening}} ({{$user->profil->no_rekening}})</a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">KTP</b> 
                    <a class="float-right fancybox" href="{{asset('u_ktp')}}/{{$user->profil->ktp}}" data-fancybox="gallery1">
                    <img class="profile-user-img img-fluid"
                       src="{{asset('u_ktp')}}/{{$user->profil->ktp}}" alt="Gambar KTP"></a>
                  </li>
                  <li class="list-group-item">
                    <b style="color:#212529">Alamat</b> <a class="float-right">{{$user->profil->alamat}}</a>
                  </li>
                </ul>
                <a href="{{route('profile.editeditor',$user->profil->id)}}" class="btn btn-dark btn-block"><b>Edit Profile</b></a>
              @endif
              <!-- end profile -->
              </div>
              <!-- /.card-body -->
            </div>
</div>
@endsection