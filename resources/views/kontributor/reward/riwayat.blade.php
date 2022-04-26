@extends('master.template')
@section('title','Riwayat Rewards')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- <a href="{{route('category.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Category</a> -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Point</b></span>
                @foreach($jumlah_point as $isi_point)
                <span class="info-box-text">
                 {{$isi_point->point}}
                </span>
                <a href="" data-toggle="modal" data-target="#add-{{$isi_point->id}}" class="btn btn-sm btn-success">Withdraw</a>
                @endforeach
              </div>
              <!-- /.info-box-content -->

            </div>

            <!-- /.info-box -->
          </div>
         

          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Riwayat Pendapatan Point</b></h3>

                <div class="card-tools">
                 <form action="history-reward" method="get" >
                  <div class="input-group input-group-sm" style="width: 500px;">
                    <label for="tanggal_awal" class="mr-2"> Tanggal Awal</label>
                    <input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal">
                    <label for="tanggal_awal" class="mr-2 ml-2"> Tanggal Akhir</label>
                    <input type="date" class="form-control" name="tanggal_akhir">
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
                      <th>Riwayat</th>
                      <th>Point</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_history as $history)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$history->aktivitas}}</td>
                      <td>{{$history->point}}</td>
                      <td>{{$history->tanggal}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
                <div class="d-flex justify-content-end mr-3">
                  {{$data_history->links()}}
                </div>
            </div>
            <!-- /.card -->
          </div>
        </div>



<!-- edit -->
@foreach($jumlah_point as $isipoint)
<div class="modal fade" id="add-{{$isipoint->id}}" tabindex="-1" role="dialog" aria-labelledby="perpanjangan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-id-badge"></i> <b>Publish Postingan</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('proses_transaksi_kontributor',$isipoint->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label>Jumlah Point Yang Ditukarkan</label>
          <input type="number" name="pengajuan" class="form-control">
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
<!-- End Modal -->
@endforeach

@endsection