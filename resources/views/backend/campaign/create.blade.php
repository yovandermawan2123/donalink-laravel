@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Campaign</h1>
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
            <form action="/campaign" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="form-group">
                                <label>Name</label>
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label>Slug</label>
                                <input id="slug" type="text" name="slug" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">--- Select Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Target</label>
                                <input id="target" type="text" oninput="formatCurrency(this)" name="target"
                                    class="form-control">
                            </div>
                        </div>


                        <div class="col-8">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
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

        $('#name').on('input', function() {
            // Get the current value of the input field
            var value = $(this).val();

            $('#slug').val(convertToSlug(value));
        });
    </script>
@endpush
