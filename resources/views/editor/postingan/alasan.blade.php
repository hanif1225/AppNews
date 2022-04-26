@extends('master.template')
@section('title','Alasan Penolakan')   
@section('content')   

    <div class="col-md-9 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Alasan Penolakan Postingan</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('editorrejected',$postingan->slug)}}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
                <div class="card-body">
                  <!-- row1 -->
                  <div class="form-group">
                    <div class="col-sm-10">
                    <input id="alasan" type="hidden" name="alasan" value="" required>
                    <trix-editor input="alasan"></trix-editor>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark">Kirim</button>
                  <a href="{{URL::previous()}}" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
    


@endsection