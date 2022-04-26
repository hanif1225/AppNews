@extends('master.template')
@section('title','Dashboard')

@section('content')


        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

            <div class="col-lg-1 col-6">
            </div>

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
                <a href="{{route('postingan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{route('postingan.pending')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{route('postingan_reject')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
@endsection