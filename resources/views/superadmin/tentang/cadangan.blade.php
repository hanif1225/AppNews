




 //isi cadangan

 <div class="col-md-10 container">
        <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title" ><b>Tambah Tentang</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{route('tentang_store')}}" method="POST" enctype="multipart/form-data" id="submitform">
              @csrf
              <textarea class="form-control" id="isi" name="isi"></textarea>
              <button type="submit" class="btn btn-success mt-2 mb-2 ml-2"> Simpan</button>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
      CKEDITOR.replace( 'isi', {
          filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
      });

      $(document).ready(function(){
        $('body').on('submit','#submitform', function(e){
        e.preventDefault();

        $.ajax({
          url:$(this).attr('action'),
          data: new FormData(this),
          type: 'POST',
          contentType: false,
          cache : false,
          processData:false,
          success:function(data){
            alert(data.msg);
          }
        });
      });
    });  
    </script>     