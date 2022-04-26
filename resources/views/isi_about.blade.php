<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Binduz - News Magazine Html Template</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('template2')}}/assets/images/favicon.ico" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/bootstrap.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/font-awesome.min.css">

    <!--====== nice select css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/nice-select.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/slick.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('template2')}}/assets/css/style.css">


</head>

<body class="gray-bg bg-2">

    <!--====== OFFCANVAS MENU PART START ======-->

    <div class="binduz-er-news-off_canvars_overlay"></div>
    <div class="binduz-er-news-offcanvas_menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="binduz-er-news-offcanvas_menu_wrapper">
                        <div class="binduz-er-news-canvas_close">
                            <a href="javascript:void(0)"><i class="fal fa-times"></i></a>
                        </div>

                        <div class="binduz-er-news-offcanvas_footer">
                           <div class="binduz-er-news-logo text-center mb-30 mt-30">
                               <a href="index.html">
                                   <img src="assets/images/logo.png" alt="">
                               </a>
                           </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== OFFCANVAS MENU PART ENDS ======-->
    
    <!--====== SEARCH PART START ======-->

    <div class="binduz-er-news-search-box">
        <div class="binduz-er-news-search-header">
            <div class=" container mt-60">
                <div class="row">
                    <div class=" col-6">
                        <img src="{{asset('template2')}}/assets/images/logo-4.png" alt=""> <!-- search title -->
                    </div>
                    <div class=" col-6">
                        <div class="binduz-er-news-search-close float-end">
                            <button class="binduz-er-news-search-close-btn">Close <span></span><span></span></button>
                        </div> <!-- search close -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- search header -->
        <div class="binduz-er-news-search-body">
            <div class=" container">
                <div class="row">
                    <div class=" col-lg-12">
                        <div class="binduz-er-news-search-form">
                            <form action="#">
                                <input type="text" placeholder="Search for Products">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- search body -->
    </div>

    <!--====== SEARCH PART ENDS ======-->

    <!--====== BINDUZ TOP HEADER PART START ======-->
    <!--====== BINDUZ TOP HEADER PART ENDS ======-->

    <!--====== BINDUZ HEADER PART START ======-->

    <header class="binduz-er-header-area binduz-er-header-area-4">
        <div class="binduz-er-header-nav">
            <div class=" container">

            </div>
        </div>
    </header>
    <div class="binduz-er-breadcrumb-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-breadcrumb-box">
                        <nav aria-label="breadcrumb">
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--====== BINDUZ HEADER PART ENDS ======-->

    <!--====== BINDUZ AUTHOR USER PART START ======-->

    <section class="binduz-er-author-item-area pb-20">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-9">
                    <div class="binduz-er-author-item mb-40">

                        <div class="binduz-er-content">
                            <h6 class="binduz-er-title" style="color:#191970;"><i class="fas fa-lightbulb"></i> About</h6>
                        </div>

                        <div class="binduz-er-blog-details-box">
                            <div class="binduz-er-text">
                            @foreach($tentang as $tentang)
                                <article>
                                {!! $tentang->isi !!}
                                </article>
                            @endforeach
                            </div>

                       

                            <!-- <div class="row">
                            <ul class="media mb-4">
                                <li>
                                    <img src="{{asset('foto')}}/pengguna.png" alt="Avatar" class="d-flex mr-3 rounded-circle" wid>
                                    <p><a href="#">Rudi</a>has achieved 80% of his cpmpleted tasks <span class="timestamp">20 Minutes ago</span></p>
                                </li>
                            </ul>
                            </div> -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--====== BINDUZ AUTHOR USER PART ENDS ======-->

    <!--====== BINDUZ FOOTER 2 PART START ======-->


    <div class="binduz-er-footer-copyright-area binduz-er-footer-copyright-area-4">
        <div class=" container">
            <div class="row align-items-center">
                <div class=" col-lg-6">
                    <div class="binduz-er-copyright-text">
                        <p>Copyright By@<span>Infogarut</span> - 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== BINDUZ FOOTER 2 PART ENDS ======-->





    <!--====== jquery js ======-->
    <script src="{{asset('template2')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('template2')}}/assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{asset('template2')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('template2')}}/assets/js/popper.min.js"></script>

    <!--====== Slick js ======-->
    <script src="{{asset('template2')}}/assets/js/slick.min.js"></script>

    <!--====== nice select js ======-->
    <script src="{{asset('template2')}}/assets/js/jquery.nice-select.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="{{asset('template2')}}/assets/js/isotope.pkgd.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="{{asset('template2')}}/assets/js/imagesloaded.pkgd.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{asset('template2')}}/assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Main js ======-->
    <script src="{{asset('template2')}}/assets/js/main.js"></script>

</body>

</html>
