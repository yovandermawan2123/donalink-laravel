@extends('backend.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Member</h1>
        </div>
        <section class="section">
          <div class="card">
            {{-- <div class="card-header">
              <a href="category/create" class="btn btn-success">Create Category &nbsp;<i class="fas fa-plus"></i></a>
            </div> --}}
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No Telephone</th>
                    {{-- <th>Icon</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($members as $member)
                  <tr>
                    <td width="10%">{{ $loop->iteration }}</td>
                    <td >{{ $member->name }}</td>
                    <td >{{ $member->email }}</td>
                    <td >{{ $member->mobile }}</td>
                    {{-- <td><img src="../images/categories/{{ $category->icon }}" style="width: 50px;" alt=""></td> --}}
                    <td width="20%" >
                      <a href="{{ route('member.show', $member->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                      {{-- <a href="/category/{{ $category->id }}" class="btn btn-warning "><i class="fas fa-pencil-alt"></i></a>
                      <a href="/category/delete/{{ $category->id }}" class="btn btn-danger "><i class="fas fa-trash"></i></a> --}}
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
