@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Donations</h1>
        </div>

        <section class="section">
          <a href="/campaign/donations/print/{{ $campaign->id }}" class="btn btn-primary">
            <i class="fas fa-print"></i> Print
          </a>

          <br>
         
          <div class="card">
            {{-- <h4>Title : {{ $campaign->name }}</h4> --}}
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Donatur</th>
                    <th>Amount</th>
                    <th>Status</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($donations as $donation)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td width="20%" >{{ $donation->invoice_number }}</td>
                    {{-- <td>{{ $campaign->description }}</td> --}}
                    <td>{{ $donation->user->name }}</td>
                    <td>{{ rupiah($donation->amount) }}</td>
                    <td>
                      @if ($donation->status == 'paid')
                        <button class="btn btn-success">
                          {{ $donation->status }}</td>
                        </button>

                      @else
                      <button class="btn btn-warning">
                        {{ $donation->status }}</td>
                      </button>
                      @endif
                      
                   
                    {{-- <td width="20%" >
                      <a href="#" class="btn btn-warning "><i class="fas fa-pencil-alt"></i></a>
                      <a href="/campaign/delete/{{ $campaign->id }}" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                    </td> --}}
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>
        

    </section>
@endsection
