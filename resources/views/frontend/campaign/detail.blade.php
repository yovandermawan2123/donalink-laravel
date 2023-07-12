@extends('frontend.layouts.main')


@section('content')
    <!--? Blog Area Start -->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="../images/campaigns/{{ $campaign->image }}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2 style="color: #2d2d2d;">{{ $campaign->name }}
                            </h2>
                            {{-- <ul class="blog-info-link mt-3 mb-4">
                      <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                      <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                   </ul> --}}
                        <br>

                        <div class="prices d-flex justify-content-between">
                            <p>Raised:<span> {{ rupiah($campaign->donations->sum('amount')) }}</span></p>
                            <p>Goal:<span> {{ rupiah($campaign->target) }}</span></p>
                        </div>
                        <br>
                        <div class="single-skill mb-15">
                            <div class="bar-progress ">
                                <div id="bar{{ $campaign->id }}" class="barfiller" style="background-color: rgb(216, 216, 216);">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="{{ ($campaign->donations->sum('amount') / $campaign->target * 100) > 100 ? 100 : percentage($campaign->donations->sum('amount') / $campaign->target * 100) }}"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                            <p class="excert">
                                {{ $campaign->description }}
                            </p>

                            <button class="btn btn-success" id="donation_button">Donasi</button>


                        </div>
                    </div>
                    <div class="comments-area">
                        <h4># Doa-doa orang baik ({{ $campaign->comments->count() }})</h4>
                        @foreach ($campaign->comments as $comment)
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="assets/img/blog/comment_1.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            {{ $comment->comment }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">{{ $comment->user->name }}</a>
                                                </h5>
                                                <p class="date">{{ $comment->created_at }} </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        
                       
                    </div>
                    <div class="comment-form">
                        <h4>Kirimkan Doa</h4>
                        @auth
                        <form class="form-contact comment_form" method="POST" action="{{ route('store_comment') }}" id="commentForm">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" value="{{ $campaign->id }}" name="campaign_id">
                                        
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                            placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post</button>
                            </div>
                        </form>
                        @else
                        <div>
                            <button onclick="loginComment()" class="btn btn-success" id="donation_button">Login Untuk Mengirimkan Doa</button>
                        </div>
                        @endauth
                    
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        {{-- <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside> --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title" style="color: #2d2d2d;">Category</h4>
                            <ul class="list cat-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="/all-campaign?category={{ $category->slug }}" class="d-flex">
                                            <p>{{ $category->name }}</p>
                                            <p>&nbsp;({{ $category->campaigns->count() }})</p>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="/all-category" class="d-flex">
                                        <p>See More</p>
                                    </a>
                                </li>
                              
                              
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title" style="color: #2d2d2d;">Related Campaign</h4>
                            <ul class="list cat-list">
                                @foreach($related as $relate)
                                    <li>
                                        <a href="/detail-campaign/{{ $relate->slug }}" class="d-flex">
                                            <p>{{ $relate->name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="/all-category" class="d-flex">
                                        <p>See More</p>
                                    </a>
                                </li>
                              
                              
                            </ul>
                        </aside>
                     



                    </div>
                </div>
            </div>
        </div>

        @auth
        <div class="modal fade" tabindex="-1" role="dialog" id="donationModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Donasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jumlah Donasi</label>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="user_id"  id="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="campaign_id" id="campaign_id" value="{{ $campaign->id }}">
                            <input type="text" oninput="formatCurrency(this)" name="amount" id="amount" class="form-control" style="height: 40px; font-size:18px;">

                            <div class="row mt-3">
                                <div class="col-4">
                                    <button onclick="appendValue('10000')" class="genric-btn success-border small radius">Rp. 10.000</button>
                                </div>
                                <div class="col-4">
                                    <button onclick="appendValue('25000')" class="genric-btn success-border small radius">Rp. 25.000</button>
                                </div>
                                <div class="col-4">
                                    <button onclick="appendValue('50000')" class="genric-btn success-border small radius">Rp. 50.000</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <button onclick="appendValue('75000')" class="genric-btn success-border small radius">Rp. 75.000</button>
                                </div>
                                <div class="col-4">
                                    <button onclick="appendValue('100000')" class="genric-btn success-border small radius">Rp. 100.000</button>
                                </div>
                                <div class="col-4">
                                    <button onclick="appendValue('150000')" class="genric-btn success-border small radius">Rp. 150.000</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" id="btn-submit-donation" class="genric-btn success medium">Submit</button>
                    </div>
                </div>
            </div>
        </div>
       
        @endauth


    </section>
    <!-- Blog Area End -->
@endsection

@push('scripts')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-4QweGF8C5Qpy6jzI') }}"></script>
    <script>
        var url_endpoint = '{{ env("APP_URL_NEW", "http://127.0.0.1:8000/") }}';
        @auth

        $('#donation_button').click(function() {
            $('#donationModal').modal('show')

        })
      
        $('#btn-submit-donation').click(function() {
            var user_id = $('#user_id').val()
            var campaign_id = $('#campaign_id').val()
            var amount = $('#amount').val()
        
            $.ajax({
            url: "{{ route('store_donation') }}",
            type: "post",
            data: {
                _token: $('#token').val(),
                user_id : user_id,
                campaign_id : campaign_id,
                amount : amount
            },
            success: function (response) {
                console.log(response.data.snap_token);
                if (response.status == 'error') {
                    Swal.fire('Error', response.message, 'error');
                } else {
                    $('#donationModal').modal('hide')
                    // console.log(response);
                  // console.log('test');
                    // var invoice = response.data.invoice_url;
                    // $('#kt_modal_payment').addClass('is-active');
                    // $('#kt_modal_payment').find('iframe').attr('src',invoice);
                    snap.pay(response.data.snap_token, {
                        // Optional
                        onSuccess: function(result) {
                            /* You may add your own js here, this is just example */
                            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            console.log(result, 'success')
                            // send_response_to(result)
                            // window.location.reload();
                            // window.location.href = "{{URL::to('wa-mitra')}}"
                            window.location.href=window.location.href;
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            console.log(result, 'pending')
                            // send_response_to(result)
                            // window.location.reload();
                            // window.location.href = "{{URL::to('wa-mitra')}}"
                            window.location.href=window.location.href;
                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            console.log(result, 'error')
                            // send_response_to(result)
                            // window.location.reload();
                            // window.location.href = "{{URL::to('wa-mitra')}}"
                            window.location.href=window.location.href;
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }
        });

        })
        @else
            $('#donation_button').click(function() {
                Swal.fire(
                    'Anda ingin melakukan donasi?',
                    'Silahkan login terlebih dahulu untuk memulai donasi',
                    'question'
                )
            });
        @endauth

        function loginComment() {
           window.location.href = '/login';
        }
        function appendValue(input) {
            // Mengambil nilai input
            // Mendapatkan nilai input
            var value = input;

            // Menghapus karakter selain angka
            value = value.replace(/[^0-9]/g, '');

            // Mengubah menjadi format uang dengan titik sebagai pemisah ribuan
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            // Menampilkan hasil ke input

            $('#amount').val(value)
        }

        function formatCurrency(input) {
            // Mengambil nilai input
            // Mendapatkan nilai input
            var value = input.value;

            // Menghapus karakter selain angka
            value = value.replace(/[^0-9]/g, '');

            // Mengubah menjadi format uang dengan titik sebagai pemisah ribuan
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            // Menampilkan hasil ke input
            input.value = value;
        }


        
    </script>
@endpush
