@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Campaign</h1>
        </div>

        <section class="section">


          <div class="card">
            <div class="card-header">
              <a href="campaign/create" class="btn btn-success">Create Campaign &nbsp;<i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    {{-- <th>Description</th> --}}
                    <th>Target</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($campaigns as $campaign)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td width="25%" ><a href="/detail-campaign/{{ $campaign->slug }}">{{ $campaign->name }}</a></td>
                    {{-- <td>{{ $campaign->description }}</td> --}}
                    <td>{{ rupiah($campaign->target) }}</td>
                    <td>{{ $campaign->status }}</td>
                    <td width="20%" >
                      {{-- <a href="#" class="btn btn-secondary"><i class="far fa-list-alt"></i></a> --}}
                      <a href="/campaign/donations/{{ $campaign->id }}" class="btn btn-primary "><i class="fas fa-hand-holding-usd"></i></a>
                      <a href="/campaign/{{ $campaign->id }}" class="btn btn-warning "><i class="fas fa-pencil-alt"></i></a>
                      <a href="/campaign/delete/{{ $campaign->id }}" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                    </td>
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>
        

    </section>
@endsection
@push('scripts')
​@if (Session::has('success'))
<script>
    var message = "{{ session('success') }}";
    Swal.fire(
        'Success!',
        message,
        'success'
    )
</script>
@endif
@endpush