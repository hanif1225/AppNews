<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>News App|Home</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('tampilan_login')}}/images/ca.png" type="image/png">
    

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

                        <div id="menu" class="text-left ">
                            <ul class="binduz-er-news-offcanvas_main_menu">
                                <li class="binduz-er-news-menu-item-has-children binduz-er-news-active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="#"> Kategori</a>
                                    <ul class="binduz-er-news-sub-menu">
                                        @foreach($category as $kategori)
                                            <li><a href="{{route('show_kategori',$kategori->slug)}}">{{$kategori->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="archived.html">Trending </a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="author.html">Top Likes</a>
                                </li>

                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="{{route('umum_tentang')}}"> Tentang Kami</a>
                                </li>
                                <li class="binduz-er-news-menu-item-has-children">
                                    <a href="{{route('bantuan')}}"> Contact</a>
                                </li>
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
                            <li>
                                <span class="binduz-er-toggle-btn binduz-er-news-canvas_open"><i class="fal fa-bars"></i> Menu</span>
                            </li>
                            <!-- <li>
                                <a class="binduz-er-news-search-open" href="#"><i class="fal fa-search"></i> Search</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class=" col-lg-6 col-md-7">
                    <div class="binduz-er-news-top-header-weather">
                        <ul>
                            @if(auth()->user() == null)
                            <li><a href="{{route('login')}}"><i class="fal fa-user"></i> Login/Sign</a></li>
                            @else
                            <li><a href="{{route('home')}}"><i class="fal fa-user"></i> Dashboard</a></li>
                            @endif
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
                            <!-- iklan -->
                            <!-- <div class="binduz-er-header-add">
                                <img src="{{asset('template2')}}/assets/images/space-bg-3.jpg" alt="">
                            </div> -->
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
                                            <a class="nav-link" href="author.html">Top Likes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('bantuan')}}">Contact</a>
                                        </li>
                                    </ul>
                                </div> <!-- navbar collapse -->
                                <form class="d-flex">
                                    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-success" type="submit">Search</button>
                                </form>

                            </nav>
                        </div> <!-- navigation -->
                    </div>
                </div> <!-- row -->
            </div>
        </div>
    </header>

    <!--====== BINDUZ HEADER PART ENDS ======-->

    <!--====== BINDUZ LATEST NEWS PART START ======-->

    <div class="binduz-er-news-slider-area pt-30 pb-60">
        <div class=" container">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Trending</h3>
                    </div>
            <div class="binduz-er-news-slider-box">
                <div class="row g-0 align-items-center">
                    <div class=" col-lg-6">
                        <div class="binduz-er-news-slider-item">
                        @foreach($postingan_trending as $post1)
                            <div class="binduz-er-item">
                                <img src="{{asset('postingan')}}/{{$post1->gambar }}" alt="">
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class=" col-lg-6">
                        <div class="binduz-er-news-slider-content-slider">
                        @foreach($postingan_trending as $post2)
                            <div class="binduz-er-item">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="{{route('show_kategori',$post2->category->slug)}}">{{$post2->category->name }}</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i> {{\Carbon\Carbon::parse($post2->tanggal)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="binduz-er-news-slider-content">
                                    <h3 class="binduz-er-title"><a href="{{route('artikel_show',$post2->slug)}}">{{$post2->judul }}</a></h3>
                                    <p>{{$post2->excerpt}}</p>
                                </div>
                                <div class="binduz-er-meta-author">
                                    <div class="binduz-er-author">
                                      
                                        <span>By <span>{{$post2->user->name  }}</span></span>
                                    </div>
                                    <?php $id= $post2['id'] ?>
                                    <?php $hs_komen = $data_komentar->where('postingan_id',$id)->where('status','aktif')->count(); ?>

                                    <div class="binduz-er-meta-list">
                                        <ul>
                                            <li><i class="fal fa-eye"></i> {{$post2->views}}</li>
                                            <li><i class="fal fa-heart"></i> {{$post2->like}}</li>
                                            <li><i class="fal fa-comments"></i> {{$hs_komen}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="binduz-er-latest-news-area pt-60">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-8">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Berita Terbaru</h3>
                    </div>
                    @foreach($postingan as $post)
                    <div class="binduz-er-latest-news-item">
                        <div class="binduz-er-thumb">
                            <img src="{{asset('postingan')}}/{{$post->gambar }}" alt="">
                        </div>
                        <div class="binduz-er-content">
                            <div class="binduz-er-meta-categories">
                                <a href="{{route('show_kategori',$post->category->slug)}}">{{$post->category->name }}</a>
                            </div>
                            <h5 class="binduz-er-title"><a href="{{route('artikel_show',$post->slug)}}">{{$post->judul}}</a></h5>
                            <p>{{$post->excerpt}}</p>
                            <div class="binduz-er-meta-item">
                                <div class="binduz-er-meta-author">
                                    <span>By <span>{{$post->user->name}}</span></span>
                                </div>
                                <div class="binduz-er-meta-date">
                                    <span><i class="fal fa-calendar-alt"></i>{{\Carbon\Carbon::parse($post->tanggal)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="binduz-er-meta-item mt-2">
                                <div class="binduz-er-meta-author">

                                <?php  $postingan_id= $post['id'] ?>
                                <?php $hasil_komen = $data_komentar->where('postingan_id',$postingan_id)->where('status','aktif')->count(); ?>

                                <span><a href="#" class="text-danger"><i class="fas fa-heart"></i></a> {{ $post->like}}</span>
                                </div>

                                <div class="binduz-er-meta-author">
                                <span><a href="#" class="text-primary"><i class="fas fa-comment-dots"></i></a> {{$hasil_komen}}</span>
                                </div>
                                <div class="binduz-er-meta-author">
                                <span><a href="#" class="text-success"><i class="fas fa-eye"></i></a> {{$post->views}}</span>
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
                        <h3 class="binduz-er-title">Random</h3>
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

    <!--====== BINDUZ TOP NEWS PART START ======-->

    <section class="binduz-er-top-news-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-4">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Top Likes</h3>
                    </div>
                @foreach($postingan_like as $postlike)
                    <div class="binduz-er-top-news-item">
                        <span>{{ ++$no }}</span>
                        <h5 class="binduz-er-title"><a href="{{route('artikel_show',$postlike->slug)}}">{{$postlike->judul}}</a></h5>
                        <div class="binduz-er-meta-date">
                            <span><i class="fal fa-calendar-alt"></i> {{\Carbon\Carbon::parse($postlike->tanggal)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class=" col-lg-4">
                    <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Most Viewed</h3>
                    </div>
                    <div class="binduz-er-news-viewed-most-slide">
                    @foreach($postingan_views as $postingan_views)
                        <div class="binduz-er-news-viewed-most">
                            <div class="binduz-er-thumb">
                                <img src="{{asset('postingan')}}/{{$postingan_views->gambar }}" alt="">
                            </div>
                            <div class="binduz-er-content">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="#">{{$postingan_views->category->name }}</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i> {{\Carbon\Carbon::parse($postingan_views->tanggal)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <h4 class="binduz-er-title"><a href="{{route('artikel_show',$postingan_views->slug)}}">{{$postingan_views->judul}}</a></h4>
                                <div class="binduz-er-meta-author">
                                    
                                    <span>By <span>{{$postingan_views->user->name}}</span></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                      
                    </div>
                </div>
                
                <div class=" col-lg-4">
                <div class="binduz-er-top-news-title">
                        <h3 class="binduz-er-title">Share Medsos</h3>
                    </div>
                    <div class="binduz-er-social-list">
                        <div class="binduz-er-list">
                            <a href="#">
                                <span><i class="fab fa-facebook-f"></i> </span>
                                <span>Share</span>
                            </a>
                            <a href="#">
                                <span><i class="fab fa-twitter"></i> </span>
                                <span>Share</span>
                            </a>
                            <a href="#">
                                <span><i class="fab fa-instagram"></i></span>
                                <span>Share</span>
                            </a>
                            <a href="#">
                                <span><i class="fab fa-whatsapp "></i></span>
                                <span>Share</span>
                            </a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== BINDUZ TOP NEWS PART ENDS ======-->

    <!--====== BINDUZ NEWS SLIDER PART START ======-->

    <!-- <div class="binduz-er-news-slider-area pt-30 pb-60">
        <div class=" container">
            <div class="binduz-er-news-slider-box">
                <div class="row g-0 align-items-center">
                    <div class=" col-lg-6">
                        <div class="binduz-er-news-slider-item">
                            <div class="binduz-er-item">
                                <img src="{{asset('template2')}}/assets/images/news-slider-1.jpg" alt="">
                            </div>
                            <div class="binduz-er-item">
                                <img src="{{asset('template2')}}/assets/images/news-slider-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6">
                        <div class="binduz-er-news-slider-content-slider">
                            <div class="binduz-er-item">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="#">Technology</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                    </div>
                                </div>
                                <div class="binduz-er-news-slider-content">
                                    <h3 class="binduz-er-title"><a href="#">Spot misinformation online with these tips</a></h3>
                                    <p>How effectively the massive shopping center can repurpose more than 300,000 square feet soon to be vacated</p>
                                </div>
                                <div class="binduz-er-meta-author">
                                    <div class="binduz-er-author">
                                        <img src="{{asset('template2')}}/assets/images/user-2.jpg" alt="">
                                        <span>By <span>Rosalina D.</span></span>
                                    </div>
                                    <div class="binduz-er-meta-list">
                                        <ul>
                                            <li><i class="fal fa-eye"></i> 5k</li>
                                            <li><i class="fal fa-heart"></i> 5k</li>
                                            <li><i class="fal fa-comments"></i> 5k</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="binduz-er-item">
                                <div class="binduz-er-meta-item">
                                    <div class="binduz-er-meta-categories">
                                        <a href="#">Technology</a>
                                    </div>
                                    <div class="binduz-er-meta-date">
                                        <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                    </div>
                                </div>
                                <div class="binduz-er-news-slider-content">
                                    <h3 class="binduz-er-title"><a href="#">Take a look at these pandemic pastimes</a></h3>
                                    <p>How effectively the massive shopping center can repurpose more than 300,000 square feet soon to be vacated</p>
                                </div>
                                <div class="binduz-er-meta-author">
                                    <div class="binduz-er-author">
                                        <img src="{{asset('template2')}}/assets/images/user-2.jpg" alt="">
                                        <span>By <span>Rosalina D.</span></span>
                                    </div>
                                    <div class="binduz-er-meta-list">
                                        <ul>
                                            <li><i class="fal fa-eye"></i> 5k</li>
                                            <li><i class="fal fa-heart"></i> 5k</li>
                                            <li><i class="fal fa-comments"></i> 5k</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!--====== BINDUZ NEWS SLIDER PART ENDS ======-->

    <!--====== BINDUZ FAVORITES CATEGORIES PART START ======-->

    <!-- <section class="binduz-er-favorites-categories-area">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="binduz-er-favorites-categories-box">
                        <div class="binduz-er-top-news-title">
                            <h3 class="binduz-er-title">Favorites Categories</h3>
                        </div>
                        <div class="binduz-er-favorites-categories-list">
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-1.png" alt="">
                                    <span>Sports</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-2.png" alt="">
                                    <span>Covid-19</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-3.png" alt="">
                                    <span>Journal</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-4.png" alt="">
                                    <span>Beating</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-5.png" alt="">
                                    <span>Movies</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-6.png" alt="">
                                    <span>Magazine</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-7.png" alt="">
                                    <span>Film</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-8.png" alt="">
                                    <span>Games</span>
                                </a>
                            </div>
                            <div class="binduz-er-item">
                                <a href="#">
                                    <img src="{{asset('template2')}}/assets/images/favorites-categories-9.png" alt="">
                                    <span>Nature</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!--====== BINDUZ FAVORITES CATEGORIES PART ENDS ======-->

    <!--====== BINDUZ RECENTLY VIEWED PART START ======-->

    <!-- <section class="binduz-er-recently-viewed-area">
        <div class=" container">
            <div class="binduz-er-recently-viewed-box">
                <div class="row">
                    <div class=" col-lg-12">
                        <div class="binduz-er-top-news-title">
                            <h3 class="binduz-er-title">Recently Viewed</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-3">
                        <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                            <div class="binduz-er-latest-news-item">
                                <div class="binduz-er-thumb">
                                    <img src="{{asset('template2')}}/assets/images/recently-viewed-thumb-1.jpg" alt="">
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
                                    <h5 class="binduz-er-title"><a href="#">Identifica la información falsa en línea con estos consejos</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3">
                        <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                            <div class="binduz-er-latest-news-item">
                                <div class="binduz-er-thumb">
                                    <img src="{{asset('template2')}}/assets/images/recently-viewed-thumb-2.jpg" alt="">
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
                                    <h5 class="binduz-er-title"><a href="#">Career certificates and more ways we're helping job seekers</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3">
                        <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                            <div class="binduz-er-latest-news-item">
                                <div class="binduz-er-thumb">
                                    <img src="{{asset('template2')}}/assets/images/recently-viewed-thumb-3.jpg" alt="">
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
                                    <h5 class="binduz-er-title"><a href="#">Get the full news story with Full Coverage in Search</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3">
                        <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                            <div class="binduz-er-latest-news-item">
                                <div class="binduz-er-thumb">
                                    <img src="{{asset('template2')}}/assets/images/recently-viewed-thumb-4.jpg" alt="">
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
                                    <h5 class="binduz-er-title"><a href="#">We pack in here just the things to start a News</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!--====== BINDUZ RECENTLY VIEWED PART ENDS ======-->
    
    <!--====== BINDUZ NEWSLETTER PART START ======-->



    <!--====== BINDUZ NEWSLETTER PART ENDS ======-->
    
    <!--====== FOOTER ADD  PART START ======-->

    <div class="binduz-er-footer-add pb-60">
        <div class=" container">
            <div class="row">
                <div class=" col-lg-12">
                <!-- Iklan footer -->
                    <!-- <div class="binduz-er-footer-add-item text-center">
                        <span class="mb-10 d-inline-block">ADVERTISEMENT</span>
                        <img src="{{asset('template2')}}/assets/images/space-bg-4.jpg" alt="">
                    </div> -->
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
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
                                            <li><a href="{{route('umum_tentang')}}">Tentang Kami</a></li>
                                            <li><a href="{{route('umum_kebijakan')}}">Kebijakan Privasi</a></li>
                                            
                                        </ul>
                                        <ul>
                                            <li><a href="{{route('bantuan')}}">Contact us</a></li>
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
                            <p>Copyright By@<span>Hanif</span> - 2021</p>
                        </div>
                    </div>
                    <div class=" col-lg-6">
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
