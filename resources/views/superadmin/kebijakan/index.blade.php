@extends('master.template')
@section('title','Kebijakan')   
@section('content')  

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif


<div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
              <i class="fas fa-exclamation"></i> <b> Kebijakan</b>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
              @if($kebijakan->count() == 0)
              <a href="{{route('create_kebijakan')}}" class="btn btn btn-success" ><b>Tambah</b></a>
              @endif
                
              @foreach($kebijakan as $kebijakan)
              @if($kebijakan != null)
              <a href="{{route('edit_kebijakan',$kebijakan->id)}}" class="btn btn btn-primary" ><b>Edit</b></a>
              @endif
                <article>
                    {!! $kebijakan->isi !!}
                </article>

              @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>

@endsection