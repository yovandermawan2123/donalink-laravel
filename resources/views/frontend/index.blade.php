@extends('frontend.layouts.main')


@section('content')
  <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    {{-- <img src="../frontend_template//img/logo/loder.png" alt=""> --}}
                </div>
            </div>
        </div>
    </div>
<div class="slider-area">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInUp" data-delay=".6s">Bantuan<br> untuk sesama.</h1>
                            <P data-animation="fadeInUp" data-delay=".8s" >Onsectetur adipiscing elit, sed do eiusmod tempor incididunt ut bore et dolore magnt, sed do eiusmod.</P>
                            <!-- Hero-btn -->
                            <div class="hero__btn">
                                <a href="/all-campaign" class="btn hero-btn mb-10"  data-animation="fadeInLeft" data-delay=".8s">Donasi</a>
                                {{-- <a href="industries.html" class="cal-btn ml-15" data-animation="fadeInRight" data-delay="1.0s">
                                    <i class="flaticon-null"></i>
                                    <p>+12 1325 41</p>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInUp" data-delay=".6s">Our Helping to<br> the world.</h1>
                            <P data-animation="fadeInUp" data-delay=".8s" >Onsectetur adipiscing elit, sed do eiusmod tempor incididunt ut bore et dolore magnt, sed do eiusmod.</P>
                            <!-- Hero-btn -->
                            <div class="hero__btn">
                                <a href="/all-campaign" class="btn hero-btn mb-10"  data-animation="fadeInLeft" data-delay=".8s">Donasi</a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!--? About Law Start-->
<section class="about-low-area section-padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10">
                <div class="about-caption mb-50">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-35">
                        <span>Tentang</span>
                        <h2>Bersatu dalam misi untuk membantu mereka yang kesusahan</h2>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,mod tempor incididunt ut labore et dolore magna aliqua. Utnixm, quis nostrud exercitation ullamc.</p>
                    <p>Lorem ipvsum dolor sit amext, consectetur adipisicing elit, smod tempor incididunt ut labore et dolore.</p>
                </div>
                {{-- <a href="about.html" class="btn">About US</a> --}}
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- about-img -->
                <div class="about-img ">
                    <div class="about-font-img d-none d-lg-block">
                        {{-- <img src="../frontend_template//img/gallery/about2.png" alt=""> --}}
                    </div>
                    <div class="about-back-img ">
                        <img src="../frontend_template//img/gallery/about1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Law End-->
<!-- Want To work -->
<section class="wantToWork-area ">
    <div class="container">
        <div class="wants-wrapper w-padding2  section-bg" data-background="../frontend_template//img/gallery/section_bg01.png">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-5 col-lg-9 col-md-8">
                    <div class="wantToWork-caption wantToWork-caption2">
                        <h2>Peduli Sesama dengan Rasa Kemanusiaan</h2>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4">
                    <a href="#" class="btn white-btn f-right sm-left">Donasi Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Want To work End -->
<!-- Our Cases Start -->
<div class="our-cases-area section-padding30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <span>Campaign kami yang dapat anda lihat</span>
                    <h2>Jelajahi Campaign kami yang sedang kami galakan </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($campaigns as $campaign)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-cases mb-40">
                    <div class="cases-img">
                        <img src="../images/campaigns/{{ $campaign->image }}" alt="">
                    </div>
                    <div class="cases-caption">
                        <h3><a href="/detail-campaign/{{ $campaign->slug }}">{{ $campaign->name }}</a></h3>
                        <!-- Progress Bar -->
                        <div class="single-skill mb-15">
                            <div class="bar-progress">
                                <div id="bar{{ $campaign->id }}" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="{{ ($campaign->donations->sum('amount') / $campaign->target * 100) > 100 ? 100 : percentage($campaign->donations->sum('amount') / $campaign->target * 100) }}"></span>
                                </div>
                            </div>
                        </div>
                        <!-- / progress -->
                        <div class="prices d-flex justify-content-between">
                            <p>Raised:<span> {{ rupiah($campaign->donations->sum('amount')) }}</span></p>
                            <p>Goal:<span> {{ rupiah($campaign->target) }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-cases mb-40">
                    <div class="cases-img">
                        <img src="../frontend_template//img/gallery/case2.png" alt="">
                    </div>
                    <div class="cases-caption">
                        <h3><a href="#">Providing Healthy Food For The Children</a></h3>
                        <!-- Progress Bar -->
                        <div class="single-skill mb-15">
                            <div class="bar-progress">
                                <div id="bar2" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="25"></span>
                                </div>
                            </div>
                        </div>
                        <!-- / progress -->
                        <div class="prices d-flex justify-content-between">
                            <p>Raised:<span> $20,000</span></p>
                            <p>Goal:<span> $35,000</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-cases mb-40">
                    <div class="cases-img">
                        <img src="../frontend_template//img/gallery/case3.png" alt="">
                    </div>
                    <div class="cases-caption">
                        <h3><a href="#">Supply Drinking Water For  The People</a></h3>
                        <!-- Progress Bar -->
                        <div class="single-skill mb-15">
                            <div class="bar-progress">
                                <div id="bar3" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="50"></span>
                                </div>
                            </div>
                        </div>
                        <!-- / progress -->
                        <div class="prices d-flex justify-content-between">
                            <p>Raised:<span> $20,000</span></p>
                            <p>Goal:<span> $35,000</span></p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="d-flex align-items-center justify-content-center">
                <a href="/all-campaign" class="btn btn-success">More</a>
        </div>


    </div>
</div>
<!-- Our Cases End -->

<!--? Team Ara Start -->

<!-- Team Ara End -->



<!--? Count Down Start -->
<div class="count-down-area pt-25 section-bg" data-background="../frontend_template//img/gallery/section_bg02.png">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="count-down-wrapper" >
                    <div class="row justify-content-between">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter text-center">
                                <span class="counter color-green">6,200</span>
                                <span class="plus">+</span>
                                <p class="color-green">Donation</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter text-center">
                                <span class="counter color-green">80</span>
                                <span class="plus">+</span>
                                <p class="color-green">Fund Raised</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter text-center">
                                <span class="counter color-green">256</span>
                                <span class="plus">+</span>
                                <p class="color-green">Donation</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter text-center">
                                <span class="counter color-green">256</span>
                                <span class="plus">+</span>
                                <p class="color-green">Donation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Count Down End -->
@endsection
