@extends('frontend.layouts.main')


@section('content')
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 pt-20 text-center">
                            <h2>Our Campaign</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- Our Cases Start -->
    <div class="our-cases-area ">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Filter Category</label>
                        <select class="form-control w-100" id="filter">
                            <option value="/all-campaign">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="/all-campaign?category={{ $category->slug }}"
                                    {{ request()->get('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>
            @if (count($campaigns) > 0)
            <div class="row mt-5">
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
                                                <span class="fill"
                                                    data-percentage="{{ ($campaign->donations->sum('amount') / $campaign->target) * 100 > 100 ? 100 : percentage(($campaign->donations->sum('amount') / $campaign->target) * 100) }}"></span>
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
            </div>
            @else
                    <div class="mt-5 mb-5">
                        <div class="hero-cap hero-cap2 pt-20 text-center">
                            <h2 style="color: grey;">Tidak ada data</h2>
                        </div>
                    </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#filter').change(function() {
            var selectedOption = $(this).val();
            // if (selectedOption !== '') {
            window.location.href = selectedOption;
            // }
        });
    </script>
@endpush
