@extends('master.template')
@section('title','Dashboard')

@section('content')
<!-- Row 1 -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-1">
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah User</span>
                <span class="info-box-number">
                  {{$jumlah_user}}
                </span>
                <a href="{{route('datapengguna')}}" >Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Kontributor</span>
                <span class="info-box-number">
                {{$jumlah_kontributor}}
                </span>
                <a href="{{route('datapengguna')}}" >Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Editor</span>
                <span class="info-box-number">{{$jumlah_editor}}</span>
                <a href="{{route('datapengguna')}}" >Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<!-- End Row 1 -->

<!--Row 2 -->
<div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">

            </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengajuan Transaksi</span>
                <span class="info-box-number">
                  {{$jumlah_pengajuan}}
                </span>
                <a href="{{route('pengajuan_reward')}}" >Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Transaksi Berhasil</span>
                <span class="info-box-number">
                  {{$jumlah_pengajuan_success }}
                </span>
                <a href="{{route('riwayat_reward')}}" >Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


            <div class="col-lg-3 col-6">
            </div>
            <!-- ./col -->
          </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
<!--End Row 2 -->


<!--Row 3 -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$jumlah_postingan}}</h3>

                    <p>Postingan Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sticky-note"></i>
                </div>
                <a href="{{route('postingan_adm')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                <div class="inner">
                <h3>{{$jumlah_pending}}</h3>

                    <p>Postingan Pending</p>
                </div>
                <div class="icon">
                <i class="fas fa-sticky-note"></i>
                </div>
                <a href="{{route('postingan_pending_adm')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$jumlah_draft}}</h3>

                    <p>Draft Postingan</p>
                </div>
                <div class="icon">
                <i class="fas fa-sticky-note"></i>
                </div>
                <a href="{{route('postingan_draft_adm')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{$jumlah_tolak}}</h3>

                    <p>Postingan Ditolak</p>
                </div>
                <div class="icon">
                <i class="fas fa-sticky-note"></i>
                </div>
                <a href="{{route('postingan_ditolakadm')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
          </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
<!--End Row 3 -->

<!--Row 4 -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-6">
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{$jumlah_editing}}</h3>

                    <p>Postingan Editing</p>
                </div>
                <div class="icon">
                <i class="fas fa-sticky-note"></i>
                </div>
                <a href="{{route('postingan_adm_editing')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
            </div>
            <!-- ./col -->
          </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
<!--End Row 4 -->




@endsection