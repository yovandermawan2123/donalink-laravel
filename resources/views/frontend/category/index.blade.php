@extends('frontend.layouts.main')


@section('content')
<div class="slider-area2">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 pt-20 text-center">
                        <h2>Category</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
<!-- Our Cases Start -->
<div class="our-cases-area " style="margin-top:30px;">
    <div class="container">
        <div class="row">

            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="/all-campaign?category={{ $category->slug }}">
                <div class="single-cases mb-40">
                    <div class="cases-img">
                        @if ($category->image != null)
                            <img src="../images/categories/{{ $category->image }}" alt="" style="width: 100%; height:200px; ">
                        @else
                        <div class="py-5" style="width: 100%; height:200px; background-color: grey;">
                            <h1 class="text-white text-center">No Image Avaliable</h1>
                        </div>
                        @endif
                        
                        <div class="text-center px-5" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -70%); background-color: rgba(9, 204, 127, 0.9); color: #fff; padding: 10px;">
                            {{ $category->name }}
                          </div>
                    </div>
                </div>
            </div>
        </a>

            @endforeach
           
        
        </div>
    </div>
</div>

@endsection