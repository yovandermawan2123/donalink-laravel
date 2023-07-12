@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create User</h1>
        </div>

        {{-- <div class="card">
          <div class="card-header">
              <h4>Selamat Datang, Admin!</h4>
            </div>
            <div class="card-body">
                <p>Selamat hari Rabu, admin! Jangan lupa atur semua pengguna dan pendonasi yaa :)</p>
            </div>
        </div> --}}
        <div class="card">
          <form action="/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                          <label>Email</label>
                          <input id="email" type="email" name="email" class="form-control" >
                      </div>
                  </div>
                    <div class="col-5">
                      <div class="form-group">
                          <label>Password</label>
                          <input id="password" type="password" name="password" class="form-control" >
                      </div>
                  </div>

                  <div class="col-5">
                    <div class="form-group">
                        <label>No Telephone</label>
                        <input id="mobile" type="text" name="mobile" class="form-control" >
                    </div>
                </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Roles</label>
                            <select name="role_id" class="form-control">
                                <option value="">--- Select Roles ---</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>


            </div>


            {{-- <div class="form-group">
              <label>Select</label>
              <select class="form-control">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
              </select>
            </div>
            <div class="form-group">
              <label>Textarea</label>
              <textarea class="form-control"></textarea>
            </div> --}}
            <div class="card-footer text-right">
              <a class="btn btn-warning" href="/campaign">Back</a>
                <button class="btn btn-primary mr-1" type="submit">Submit</button>
            </div>
          </form>
        </div>
     
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        function convertToSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                .replace(/^-|-$/g, ''); // Remove leading and trailing hyphens
        }

        $('#name').on('input', function() {
            // Get the current value of the input field
            var value = $(this).val();

            $('#slug').val(convertToSlug(value));
        });

        
    </script>
@endpush
