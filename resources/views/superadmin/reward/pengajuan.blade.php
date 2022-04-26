@extends('master.template')
@section('title','Pengajuan Reward')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif


<!-- row 1 -->
        <div class="row">
          <div class="col-12">
            <div class="card">            
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-coins"></i> <b>Pengajuan Transaksi Point</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>No Wa</th>
                      <th>Nama Bank</th>
                      <th>No Rekening</th>
                      <th>Point Yang Diajukan</th>
                      <th>Nominal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($pengajuan as $p)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$p->user->name}}</td>
                      <td>{{$p->user->no_hp}}</td>
                      <td>{{$p->user->profil->nama_rekening}}</td>
                      <td>{{$p->user->profil->no_rekening}}</td>
                      <td>{{$p->pengajuan}}</td>
                      <td>Rp. {{$p->nominal}}</td>
                      <td>
                        <form action="{{route('update_pengajuan',$p->id)}}" method="post" class="d-inline">
                          @method('put')
                          @csrf
                          <button class="btn btn-sm btn-success" >Disetujui</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


@endsection