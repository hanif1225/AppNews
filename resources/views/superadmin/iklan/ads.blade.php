@extends('master.template')
@section('title','Iklan Adsense')   
@section('content')  

@if(session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
          {{session('pesan')}}
</div>
@endif

<a href="{{route('iklan_ads_create')}}" class="btn btn-success mb-3" ><i class="far fa-plus-square"></i> Tambah Iklan</a>
        <div class="row">
          <div class="col-12">
            <div class="card">
            
              <div class="card-header">
              
                <h3 class="card-title"><i class="fas fa-clipboard"></i> <b>Data Iklan Adsense</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $data)
                    <tr>
                      <td>{{$no ++}}</td>
                      <td>{{$data->judul}}</td>
                      <td>
                        <a href="{{route('iklan_ads_edit',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i> </a>
                        <form action="{{route('delete_iklan_ads',$data->id)}}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah data ingin di hapus')"><i class="fas fa-trash"></i></button>
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