@extends('master.postingan')   
@section('isi')

<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('style')}}/style.css">
            
                <!--====== BINDUZ CONTACT MAP PART START ======-->
    <div class="binduz-er-map-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31664.7215033505!2d107.89614586849463!3d-7.23055356593611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1e90e25ddc5%3A0xe74d9220620ff939!2sGarut%2C%20Kec.%20Garut%20Kota%2C%20Kabupaten%20Garut%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1639372344205!5m2!1sid!2sid" width="100" height="400" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== BINDUZ CONTACT MAP PART ENDS ======-->

     <div class="binduz-er-contact-us-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-contact-us-box">
                        <form action="#">
                            <div class="binduz-er-contact-title">
                                <h4 class="binduz-er-title">Bantuan</h4>
                            </div>
                            <div class="row">
                                <div class=" col-lg-12">
                                <article class="mt-2">
                                <center>
                                @foreach($bantuan as $bantuan)
                                <a href="https://api.whatsapp.com/send?phone={{$bantuan->wa}}&text=Kepada: Info Garut" target="_blank" class="tombol-aktif btn animasi biru ml-2 mt-2"><i class="fab fa-whatsapp"></i> {{$bantuan->wa }}</a>
                                <a href="mailto:{{$bantuan->email}}" class="tombol-aktif btn animasi biru ml-2 mt-2"><i class="fas fa-envelope"></i> {{$bantuan->email}}</a>
                                @endforeach
                                </center>
                                </article>
                                </div>
                            </div>
             
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>              
          
@endsection   