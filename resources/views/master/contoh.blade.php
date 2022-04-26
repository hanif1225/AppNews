@extends('master')

@section('scripts')
<script>
function submitData() {

    let data = {
        'title' : $('#title').val()
    }

    $.post( "ajax/test.html", function( data ) {
        if(data.status == 1 ) {
            window.location = '/artikel/kategori/olahraga'
        }
    });
}
</script>
@endsection