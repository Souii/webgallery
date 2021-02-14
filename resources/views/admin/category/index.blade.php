@extends('layout.app')

@section('title', 'New Category')

@section('content')
    <div class="row justify-content-center mt-5">

        <div class="col-3">

            <div class="card text-center">
              <div class="card-header">
                <h5>Categories</h4>
              </div>

              <div class="card-body">
                  <form class="row g-2" action="{{ route('category.store') }}" method="post">
                      @csrf
                      <div class="col-9">
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            class="@error('name') is-invalid @enderror"
                            placeholder="Type a name..."
                        >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-3">
                        <button type="submit" class="form-control btn btn-primary mb-3">Add</button>
                      </div>
                    </form>

                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                            <tr>
                              <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>

        </div>


        </div>
    </div>
@endsection
