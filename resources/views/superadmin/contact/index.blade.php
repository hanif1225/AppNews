@extends('master.template')
@section('title','Kontak')   
@section('content')          

@if(session('pesan'))
<div id="flash" data-flash="{{session('pesan')}}"></div>
@endif

<div class="col-md-6 container">
            <div class="card card-dark card-outline">
              <!-- card-body -->
              <h1 align="center" style="color:#212529"><b>Kontak</b></h1>
              <div class="card-body box-profile">
                <ul class="list-group list-group-unbordered mb-3 mt-2">
                <div class="row">

                @foreach($contact as $isi)
                  <table class="table table-striped table-hover">
                  <tr>
                    <th>
                    No Whatsapp
                    </th>
                    <td>
                    {{ $isi->wa }}
                    </td>
                  </tr>
                  <tr>
                    <th>
                    Email
                    </th>
                    <td>
                    {{ $isi->email }}
                    </td>
                  </tr>
                

                  </table>
                  <a href="" class="btn btn-dark btn-block" data-toggle="modal" data-target="#edit-{{$isi->id}}"><b>Edit Kontak</b></a>
                  @endforeach
                  @if($contact->count() == 0)
                <a href="" data-toggle="modal" data-target="#add" class="btn btn-dark btn-block"><b>Tambah Kontak</b></a>
                @endif
                </ul>
              </div>
            </div>
      </div>






<!-- edit -->
@foreach($contact as $isi_edit)
<div class="modal fade" id="edit-{{$isi_edit->id}}" tabindex="-1" role="dialog" aria-labelledby="perpanjangan" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-id-badge"></i> <b>Edit Contact</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('contact_update',$isi_edit->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label>No Whatsapp</label>
          <input type="text" name="wa" value="{{$isi_edit->wa}}" class="form-control">
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="{{$isi_edit->email}}" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
@endforeach


<!-- ADD -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-id-badge"></i> <b>Tambah Kontak</b></h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="{{route('contact_store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label><i class="fab fa-whatsapp"></i> Nomor whatsapp</label>
          <input type="text" name="wa" class="form-control">
        </div>

        <div class="form-group">
          <label><i class="fas fa-envelope"></i> Email</label>
          <input type="email" name="email" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

@endsection