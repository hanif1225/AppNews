@extends('master.postingan')   
@section('isi')
            <div class="row">
                <div class=" col-lg-9">
                    <div class="binduz-er-author-item mb-40">

                        <div class="binduz-er-content">
                            <h6 class="binduz-er-title" style="color:#191970;"><i class="fas fa-exclamation"></i> Kebijakan</h6>
                        </div>

                        <div class="binduz-er-blog-details-box">
                            <div class="binduz-er-text">
                            @foreach($kebijakan as $kebijakan)
                                <article>
                                {!! $kebijakan->isi !!}
                                </article>
                            @endforeach
                            </div>
                            <div class="binduz-er-social-share-tag d-block d-sm-flex justify-content-between align-items-center">
                                <div class="binduz-er-tag">
                                    <ul>
                                        <li><a href="#">Popular</a></li>
                                        <li><a href="#">Desgin</a></li>
                                        <li><a href="#">UX</a></li>
                                    </ul>
                                </div>
                                <div class="binduz-er-social">
                                    <ul>
                                        <!-- <li><a href="#"><i class="fab fa-tumblr"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="binduz-er-blog-post-prev-next d-flex justify-content-between align-items-center">
                                <div class="binduz-er-post-prev-next">
                                    <a href="#">
                                        <span>Prev Post</span>
                                        <h4 class="binduz-er-title">Tips On Minimalist</h4>
                                    </a>
                                </div>
                                <div class="binduz-er-post-prev-next text-end">
                                    <a href="#">
                                        <span>Next Post</span>
                                        <h4 class="binduz-er-title">Less Is More</h4>
                                    </a>
                                </div>
                                <div class="binduz-er-post-bars">
                                    <a href="/"><img src="{{asset('template2')}}/assets/images/icon/home.png"  alt=""></a>
                                </div>
                            </div>
                            <div class="binduz-er-blog-related-post">
                                <div class="binduz-er-related-post-title">
                                    <h3 class="binduz-er-title">Related Post</h3>
                                </div>
                                <div class="binduz-er-blog-related-post-slide">
                                    <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                                        <div class="binduz-er-latest-news-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/editors-pack-thumb-1.jpg" alt="">
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
                                                <h5 class="binduz-er-title"><a href="#">This new emoji has been years in the making</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                                        <div class="binduz-er-latest-news-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/editors-pack-thumb-2.jpg" alt="">
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
                                                <h5 class="binduz-er-title"><a href="#">A dietitian’s website and blog stir up more business</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                                        <div class="binduz-er-latest-news-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/editors-pack-thumb-3.jpg" alt="">
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
                                                <h5 class="binduz-er-title"><a href="#">New resources on the gender gap in computer science</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                                        <div class="binduz-er-latest-news-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/editors-pack-thumb-4.jpg" alt="">
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
                                                <h5 class="binduz-er-title"><a href="#">Android Enterprise security delivers for flexible work</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                <div class=" col-lg-3">
                    <div class="binduz-er-populer-news-sidebar">
                        <div class="binduz-er-archived-sidebar-about">
                            <div class="binduz-er-user">
                                <img src="{{asset('template2')}}/assets/images/archived-about.png" alt="">
                                <div class="binduz-er-icon">
                                    <i class="fal fa-newspaper"></i>
                                </div>

                            </div>
                            <span>Senior Reportar</span>
                            <h4 class="binduz-er-title">Miranda H. Hilixer</h4>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>

                 

                        <div class="binduz-er-populer-news-sidebar-post pt-40">
                            <div class="binduz-er-popular-news-title">
                                <ul class="nav nav-pills mb-3" id="pills-tab-2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Most Popular</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Most Recent</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent-2">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="binduz-er-sidebar-latest-post-box">
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-1.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Why creating inclusive classrooms matters</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-2.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Celebrating Asian Pacific American art and</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-3.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">From overcoming burnout to finding new</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-4.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Sparks of inspiration to the new trend 2021</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="binduz-er-sidebar-latest-post-box">
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-1.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Why creating inclusive classrooms matters</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-2.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Celebrating Asian Pacific American art and</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-3.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">From overcoming burnout to finding new</a></h4>
                                            </div>
                                        </div>
                                        <div class="binduz-er-sidebar-latest-post-item">
                                            <div class="binduz-er-thumb">
                                                <img src="{{asset('template2')}}/assets/images/latest-post-4.jpg" alt="latest">
                                            </div>
                                            <div class="binduz-er-content">
                                                <span><i class="fal fa-calendar-alt"></i> 24th February 2020</span>
                                                <h4 class="binduz-er-title"><a href="#">Sparks of inspiration to the new trend 2021</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="binduz-er-populer-news-sidebar-newsletter binduz-er-author-page-newsletter mt-40">
                            <div class="binduz-er-newsletter-box text-center">
                                <img src="{{asset('template2')}}/assets/images/icon/icon-3.png" alt="">
                            </div>
                        </div>

                        <div class="binduz-er-populer-news-social binduz-er-author-page-social mt-40">
                            <div class="binduz-er-popular-news-title">
                                <h3 class="binduz-er-title">Social Connects</h3>
                            </div>
                            <div class="binduz-er-social-list">
                                <div class="binduz-er-list">
                                    <a href="#">
                                        <span><i class="fab fa-facebook-f"></i> <span>15000</span> Likes</span>
                                        <span>Like</span>
                                    </a>
                                    <a href="#">
                                        <span><i class="fab fa-twitter"></i> <span>15000</span> Likes</span>
                                        <span>Tweet</span>
                                    </a>
                                    <a href="#">
                                        <span><i class="fab fa-behance"></i> <span>5k+</span> Follower</span>
                                        <span>Follow</span>
                                    </a>
                                    <a href="#">
                                        <span><i class="fab fa-youtube"></i> <span>15000</span> Subscribe</span>
                                        <span>Subscribe</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="binduz-er-populer-news-social binduz-er-author-page-social mt-40">
                            <div class="binduz-er-popular-news-title">
                                <h3 class="binduz-er-title">Video Post</h3>
                            </div>
                            <div class="binduz-er-video-post binduz-er-recently-viewed-item">
                                <div class="binduz-er-latest-news-item">
                                    <div class="binduz-er-thumb">
                                        <img src="{{asset('template2')}}/assets/images/editors-pack-thumb-1.jpg" alt="">
                                        <div class="binduz-er-play">
                                            <a href="#"><i class="fas fa-play"></i></a>
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
                                        <h5 class="binduz-er-title"><a href="#">Nearly three weeks after Rita Ora and Chris Brown released their collaboration, “Body On Me,”</a></h5>
                                        <div class="binduz-er-meta-author">
                                            <span>By <span>Rosalina D.</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="binduz-er-sidebar-social binduz-er-populer-news-sidebar-add d-none d-lg-block">
                            <div class="binduz-er-sidebar-add mt-40">
                                <h3 class="binduz-er-title">Build your website & <span>grow your business</span></h3>
                                <a class="binduz-er-main-btn" href="#">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection   