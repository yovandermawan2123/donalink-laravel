@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Category</h1>
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
          <form action="/category/update/{{ $category->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ $category->name }}" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                          <label>Slug</label>
                          <input id="slug" type="text" value="{{ $category->slug }}" name="slug" class="form-control" readonly>
                      </div>
                  </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="hidden" value="{{ $category->image }}">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <img src="../images/categories/{{ $category->image }}" alt="" width="200px">
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
