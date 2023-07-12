@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        {{-- <div class="card">
          <div class="card-header">
              <h4>Selamat Datang, Admin!</h4>
            </div>
            <div class="card-body">
                <p>Selamat hari Rabu, admin! Jangan lupa atur semua pengguna dan pendonasi yaa :)</p>
            </div>
        </div> --}}
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fas fa-users"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Pengguna</h4>
                </div>
                <div class="card-body">
                 {{ $count_user }}
                </div>
              </div>
            </div>
          </div>
       
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-success">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Donasi</h4>
                </div>
                <div class="card-body">
                  {{ rupiah($donations) }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                <i class="fas fa-file-invoice-dollar"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Campaign</h4>
                </div>
                <div class="card-body">
                  {{ $campaign }}
                </div>
              </div>
            </div>
          </div>
        </div>


    </section>
@endsection
