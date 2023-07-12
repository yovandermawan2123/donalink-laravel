@extends('frontend.layouts.main')


@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <section class="featured-job-area section-bg2" data-background="assets/img/gallery/section_bg03.png">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 col-md-10 col-sm-12">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-80">
                        <h2>My Donation List</h2>
                    </div>
                </div>
            </div>

            @foreach ($donations as $donation)
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-12">
                        <!-- single-job-content -->
                        <div class="single-job-items mb-30">
                            <div class="job-items">
                                <div class="company-img">
                                    <a href="#"><img src="../images/campaigns/{{ $donation->campaign->image }}"
                                            alt="" width="150"></a>
                                </div>
                                <div class="job-tittle">
                                    <a  data-toggle="modal" data-target="#staticBackdrop-{{ $donation->id }}" style="cursor: pointer;">
                                        <h4>{{ $donation->campaign->name }}</h4>
                                    </a>
                                    <span>
                                        <p class="d-inline" style="font-size: 18px;">Jumlah Donasi :</p>
                                        <p class="text-success d-inline" style="font-size: 18px;">
                                            {{ rupiah($donation->amount) }}</p><span>
                                            <ul>
                                                <li><i class="far fa-clock"></i>{{ $donation->created_at->format('h:i') }}
                                                </li>
                                                <li><i
                                                        class="fas fa-sort-amount-down"></i>{{ $donation->created_at->format('d, F Y') }}
                                                </li>
                                            </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Launch static backdrop modal
                  </button> --}}
        
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop-{{ $donation->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-dark">Detail Donation</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                         
                            <div class="modal-body px-4">
                                <br>
                                <h3 class="text-success text-center" style="font-weight: 700;">{{ $donation->status == 'waiting for payment' ? 'Menunggu Pembayaran' : 'Donasi Telah Diterima' }}</h3>
                                <br>
                                <div class="border border-1 px-3 py-3">
                                    <p class="text-dark">Nomor Donasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; {{ $donation->invoice_number }}</p>
                                    <p class="text-dark">Status Pembayaran : &nbsp; {{ $donation->status }}</p>
                                    <p class="text-dark">Jumlah Donasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp; {{ rupiah($donation->amount) }}</p>
                                </div>

                                <br>
                                <div class="row px-3 py-3">
                                    <div class="col-4 ">
                                                    <a href="#"><img src="../images/campaigns/{{ $donation->campaign->image }}"
                                                            alt="" width="150"></a>
                                    </div>
                                    <div class="col-8">
                                        <h4 class="text-dark" style="font-weight: 700;">{{ $donation->campaign->name }}</h4>
                                        <a href="/detail-campaign/{{ $donation->campaign->slug }}" class="genric-btn success medium mt-3">Donasi Lagi</a>
                                    </div>
                
                                </div>
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div> --}}
                        </div>
                    </div>
                </div>


            @endforeach
            

        </div>
    
    </section>
@endsection
