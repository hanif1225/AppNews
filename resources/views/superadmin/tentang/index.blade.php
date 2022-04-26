@extends('master.template')
@section('title','Tentang')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif


<div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
              <i class="fas fa-lightbulb"></i> <b> Tentang</b>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
              
              @if($tentang->count() == 0)
              <a href="{{route('tentang_create_adm')}}" class="btn btn btn-success" ><b>Tambah</b></a>
              @endif
                
              @foreach($tentang as $tentang)
              @if($tentang != null)
              <a href="{{route('tentang_edit_adm',$tentang->id)}}" class="btn btn btn-primary" ><b>Edit</b></a>
              @endif
                <article>
                    {!! $tentang->isi !!}
                </article>

              @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>

@endsection