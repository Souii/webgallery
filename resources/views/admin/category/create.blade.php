@extends('layout.app')

@section('title', 'New Category')

@section('content')
    <div class="row justify-content-center mt-5">

        <div class="col-3">

            <div class="card text-center">
              <div class="card-header">
                <h5>New Category</h4>
              </div>

              <div class="card-body">
                  <form action="{{ route('category.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          class="@error('name') is-invalid @enderror"
                      >
                      @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary form-control">Create</button>

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
