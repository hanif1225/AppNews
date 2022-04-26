@extends('master.template')
@section('title','Edit Tentang')   
@section('content')   

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
              <i class="fas fa-lightbulb"></i> <b>Edit Tentang</b>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
              <div class="mb-3">
                <form class="form-horizontal" action="{{route('tentang_update_adm',$tentang->id)}}" method="POST" enctype="multipart/form-data" id="submitform">
                @method('put')
                 @csrf
                  <textarea class="textarea" placeholder="Place some text here" name="isi" id="isi"
                            style="width: 100%; height: 200px; font-size: 14px;  
                                  line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
                  {{$tentang->isi}}
                  </textarea>
                  
                  <button type="submit" class="btn btn-success mt-2 mb-2 ml-2"> Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>

@endsection