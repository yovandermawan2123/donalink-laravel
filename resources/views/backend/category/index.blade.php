@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        <section class="section">


          <div class="card">
            <div class="card-header">
              <a href="category/create" class="btn btn-success">Create Category &nbsp;<i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    {{-- <th>Icon</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>
                    <td width="10%">{{ $loop->iteration }}</td>
                    <td >{{ $category->name }}</td>
                    {{-- <td><img src="../images/categories/{{ $category->icon }}" style="width: 50px;" alt=""></td> --}}
                    <td width="20%" >
                      {{-- <a href="#" class="btn btn-secondary"><i class="far fa-list-alt"></i></a> --}}
                      <a href="/category/{{ $category->id }}" class="btn btn-warning "><i class="fas fa-pencil-alt"></i></a>
                      <a href="/category/delete/{{ $category->id }}" class="btn btn-danger "><i class="fas fa-trash"></i></a>
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
