@extends('master.template')
@section('title','Riwayat Transaksi')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- <a href="{{route('category.create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Category</a> -->
        <div class="row">

          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Riwayat Transaksi</b></h3>

                <div class="card-tools">
                 <form action="history-transaksi" method="get" >
                  <div class="input-group input-group-sm" style="width: 550px;">
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
                      <th>Tanggal</th>
                      <th>Point</th>
                      <th>Point Yang Diajukan</th>
                      <th>Nominal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_history as $history)
                    <tr>
                      <td>{{++$no}}</td>
                      <td>{{$history->tanggal}}</td>
                      <td>{{$history->reward->point}}</td>
                      <td>{{$history->pengajuan}}</td>
                      <td>{{$history->nominal}}</td>
                      <td>{{$history->status}}</td>
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

@endsection