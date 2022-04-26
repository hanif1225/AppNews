<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>News App|Category {{$title}}</title>
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

<body class="gray-bg">


    <!--====== OFFCANVAS MENU PART START ======-->

    <div class="binduz-er-news-off_canvars_overlay"></div>
    <div class="binduz-er-news-offcanvas_menu binduz-er-news-offcanvas_menu_left">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="binduz-er-news-offcanvas_menu_wrapper">
                        <div class="binduz-er-news-canvas_close">
                            <a href="javascript:void(0)"><i class="fal fa-times"></i></a>
                        </div>
                        <div class="binduz-er-news-header-social">
                            <ul class="text-center">
                                <li><a href="#">facebook</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">Skype</a></li>
                            </ul>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="binduz-er-news-offcanvas_main_menu">
                                <li class="binduz-er-news-menu-item-has-children binduz-er-news-active">
                                    <a href="#">Home</a>
                                    <ul class="binduz-er-news-sub-menu">
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                        <li><a href="index-3.html">Home 3</a></li>
                                        <li><a href="index-4.html">Home 4</a></li>
                                        <li><a href="index-5.html">Home 5</a></li>
                                        <li><a href="index-6.html">Home 6</a></li>
                                        <li><a href="index-7.html">Home 7</a></li>
                                        <li><a href="index-8.html">Home 8</a></li>
                                        <li><a href="index-9.html">Home 9</a></li>
                                        <li><a href="index-10.html">Home 10</a></li>
                                        <li><a href="index-11.html">Home 11</a></li>
                                        <li><a href="index-12.html">Home 12</a></li>
                                    </ul>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="archived.html">Archived </a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="author.html">Author</a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="#"> Pages</a>
                                    <ul class="binduz-er-news-sub-menu">
                                        <li><a href="blog-details-1.html">Blog Details 1</a></li>
                                        <li><a href="blog-details-2.html">Blog Details 2</a></li>
                                    </ul>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="about-us.html"> About</a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="contact.html"> Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="binduz-er-news-offcanvas_footer">
                           <div class="binduz-er-news-logo text-center mb-30 mt-30">
                               <a href="index.html">
                                   <img src="{{asset('template2')}}/assets/images/logo.png" alt="">
                               </a>
                           </div>
                            <p>I’m Michal Škvarenina, a multi-disciplinary designer currently working at Wild and as a freelance designer.</p>
                            <ul>
                                <li><i class="fas fa-phone"></i> +212 34 45 45 98</li>
                                <li><i class="fas fa-home"></i> Angle Bd Abdelmoumen & rue soumaya, Résidence</li>
                                <li><i class="fas fa-envelope"></i> hello@example.com</li>
                            </ul>
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

    <div class="binduz-er-news-top-header-area-2 bg_cover">
        <div class=" container">
            <div class="row align-items-center">
                <div class=" col-lg-6 col-md-5">
                    <div class="binduz-er-news-top-header-btns">
                        <ul>
                            <!-- <li>
                                <span class="binduz-er-toggle-btn binduz-er-news-canvas_open"><i class="fal fa-bars"></i> Menu</span>
                            </li> -->
                            <li>
                                <a class="binduz-er-news-search-open" href="#"><i class="fal fa-search"></i> Search</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class=" col-lg-6 col-md-7">
                    <div class="binduz-er-news-top-header-weather">
                        <ul>
                            <li><a href="{{route('login')}}"><i class="fal fa-user"></i> Login/Sign</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== BINDUZ TOP HEADER PART ENDS ======-->

    <!--====== BINDUZ HEADER PART START ======-->

    <header class="binduz-er-header-area binduz-er-header-area-2">
        <div class="binduz-er-header-nav">
            <div class=" container">
                <div class="row">
                    <div class=" col-lg-12">
                        <div class="binduz-er-header-meddle-bar d-flex justify-content-between">
                            <div class="binduz-er-logo">
                                <a href="#"><img src="{{asset('tampilan_login')}}/images/ca.png" width="150" height="150" alt=""></a>
                            </div>
                            <div class="binduz-er-header-add">
                                <img src="{{asset('template2')}}/assets/images/space-bg-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-12">
                        <div class="navigation">
                            <nav class="navbar navbar-expand-lg">
                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="/">Home </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Kategori<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub-menu">
                                            @foreach($category as $kategori)
                                                <li><a href="{{route('show_kategori',$kategori->slug)}}">{{$kategori->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="author.html">Trending</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="author.html">Daftar Iklan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="binduz-er-nav-link" href="about-us.html">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact.html">Contact</a>
                                        </li>
                                    </ul>
                                </div> <!-- navbar collapse -->

                            </nav>
                        </div> <!-- navigation -->
                    </div>
                </div> <!-- row -->
            </div>
        </div>
    </header>

    <!--====== BINDUZ HEADER PART ENDS ======-->

    <!--====== BINDUZ LATEST NEWS PART START ======-->

    <section class="binduz-er-latest-news-area pt-60">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-8">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Kategori : {{$title}}</h3>
                    </div>
                    @foreach($postingan as $post)
                    <div class="binduz-er-latest-news-item">
                        <div class="binduz-er-thumb">
                            <img src="{{asset('postingan')}}/{{$post->gambar }}" alt="">
                        </div>
                        <div class="binduz-er-content">
                            <div class="binduz-er-meta-categories">
                                <a href="#">{{$post->category->name }}</a>
                            </div>
                            <h5 class="binduz-er-title"><a href="{{route('artikel_show',$post->slug)}}">{{$post->judul}}</a></h5>
                            <div class="binduz-er-meta-item">
                                <div class="binduz-er-meta-author">
                                    <span>By <span>{{$post->user->name}}</span></span>
                                </div>
                                <div class="binduz-er-meta-date">
                                    <span><i class="fal fa-calendar-alt"></i>{{\Carbon\Carbon::parse($post->tanggal)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                <div class="d-flex justify-content-end mr-3">
                  {{$postingan->links()}}
                  
                </div>

                </div>
                <div class=" col-lg-4">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Video Post</h3>
                    </div>
                    <div class="binduz-er-video-post">
                        <div class="binduz-er-latest-news-item">
                            <div class="binduz-er-thumb">
                                <img src="{{asset('template2')}}/assets/images/latest-news-thumb-4.jpg" alt="">
                                <div class="binduz-er-play">
                                    <a class="binduz-er-video-popup" href="#"><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="binduz-er-content">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="#">Technology</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i>24th February 2020</span>
                                    </div>
                                </div>
                                <h5 class="binduz-er-title"><a href="#">Spruce up your Business Profile for holiday shoppers</a></h5>
                            </div>
                        </div>
                        <div class="binduz-er-latest-news-item">
                            <div class="binduz-er-thumb">
                                <img src="{{asset('template2')}}/assets/images/video-post-thumb.jpg" alt="">
                                <div class="binduz-er-play">
                                    <a class="binduz-er-video-popup" href="#"><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="binduz-er-content">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="#">Technology</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i>24th February 2020</span>
                                    </div>
                                </div>
                                <h5 class="binduz-er-title"><a href="#">The new conversational Search experience we’re thankful for</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== BINDUZ LATEST NEWS PART ENDS ======-->

    
    <!--====== FOOTER ADD  PART START ======-->

    <div class="binduz-er-footer-add pb-60">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-footer-add-item text-center">
                        <span class="mb-10 d-inline-block">ADVERTISEMENT</span>
                        <img src="{{asset('template2')}}/assets/images/space-bg-4.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== FOOTER ADD  PART ENDS ======-->
    
    <!--====== BINDUZ FOOTER 2 PART START ======-->

    <footer class="binduz-er-footer-2-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-footer-box">
                        <div class="row">
                            <div class=" col-lg-4">
                                <div class="binduz-er-footer-about text-center">
                                    <div class="binduz-er-logo">
                                        <a href="#"><img src="{{asset('tampilan_login')}}/images/ca.png"  width="100" height= "100" alt="Logo"></a>
                                    </div>
                                    <p>Michael Madigan on Sunday was confronted with the reality that he lacks support from nearly a third.</p>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" col-lg-4">
                               <div class="binduz-er-footer-gallery ml-50">
                                    <div class="binduz-er-footer-title">
                                        <h4 class="binduz-er-title">Photo Showcase</h4>
                                    </div>
                                    <div class="binduz-er-footer-gallery-widget d-flex">
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-1.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-3.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="binduz-er-footer-gallery-widget d-flex">
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-4.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="binduz-er-item">
                                            <a href="#">
                                                <img src="{{asset('template2')}}/assets/images/footer-gallery-6.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-4">
                                <div class="binduz-er-footer-navigation">
                                    <div class="binduz-er-footer-title">
                                        <h3 class="binduz-er-title">Company Info</h3>
                                    </div>
                                    <div class="binduz-er-footer-list">
                                        <ul>
                                            <li><a href="#">About us</a></li>
                                            <li><a href="#">Terms of Service</a></li>
                                            <li><a href="#">Contact us</a></li>
                                            <li><a href="#">Local print ads</a></li>
                                            <li><a href="#">FAQ</a></li>
                                            <li><a href="#">Media kit</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#">Careers</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Archives</a></li>
                                            <li><a href="#">Coupons</a></li>
                                            <li><a href="#">Manage Web Notifications</a></li>
                                            <li><a href="#">Chicago Tribune Store</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="binduz-er-footer-copyright-area binduz-er-footer-copyright-area-2">
        <div class=" container">
           <div class="binduz-er-footer-copyright-box">
                <div class="row align-items-center">
                    <div class=" col-lg-6">
                        <div class="binduz-er-copyright-text">
                            <p>Copyright By@<span>QuomodoTheme</span> - 2021</p>
                        </div>
                    </div>
                    <div class=" col-lg-6">
                        <div class="binduz-er-copyright-menu float-lg-end float-none">                    
                            <ul>
                                <li><a href="#">Privacy & Policy</a></li>
                                <li><a href="#">Claim A Report</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
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
