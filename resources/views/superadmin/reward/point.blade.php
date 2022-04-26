@extends('master.template')
@section('title','Kelola Point')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<!-- row 1 -->
        <div class="row">
          <div class="col-12">
            <div class="card">            
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-coins"></i> <b>Harga Point</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 120px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Point</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($nominal as $nm)
                    <tr>
                      <td>1 Point</td>
                      <td>Rp {{$nm->harga}}</td>
                      <td>
                        <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editing-{{$nm->id}}"><i class="fas fa-edit"></i></a>
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


<!-- row 2 -->
<div class="row">
          <div class="col-12">
            @if($data_point->count() == 0)
          <a href="" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#add">Tambah Data Point</a>
            @endif  
          <div class="card">            
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-coins"></i> <b>Data Point</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 120px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Point Baca</th>
                      <th>Point Referal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_point as $p)
                    <tr>
                      <td>{{$p->point_baca}}</td>
                      <td>{{$p->point_referal}}</td>
                      <td>
                        <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editingcoin-{{$p->id}}"><i class="fas fa-edit"></i></a>
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


<!-- edit nominal-->
@foreach($nominal as $num)
<div class="modal fade" id="editing-{{$num->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-coins"></i> <b>Edit Harga Point</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('pengajuan_reward_update',$num->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label>Point</label>
          <input type="number" name="harga" value="{{$num->harga}}" class="form-control">
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

<!-- Add Data  point-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-coins"></i> <b>Tambah Point</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('point_store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Point Baca</label>
          <input type="number" name="point_baca" class="form-control">
        </div>
        <div class="form-group">
          <label>Point Referal</label>
          <input type="number" name="point_referal" class="form-control">
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

<!-- edit point-->
@foreach($data_point as $isi_point)
<div class="modal fade" id="editingcoin-{{$isi_point->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-coins"></i> <b>Edit Point</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('point_update',$isi_point->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label>Point Baca</label>
          <input type="number" name="point_baca" value="{{$isi_point->point_baca}}" class="form-control">
        </div>
        <div class="form-group">
          <label>Point Referal</label>
          <input type="number" name="point_referal" value="{{$isi_point->point_referal}}" class="form-control">
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