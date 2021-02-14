@extends('layout.app')

@section('title', 'New Image')

@section('content')
    <div class="row justify-content-center">

        <div class="col-4">

            <div class="card">
              <div class="card-header">
                <h5>Upload Image</h4>
              </div>
              <div class="card-body">
                  <form x-data="getSource()" x-on:submit="prepareToSubmit" x-ref="imageForm" action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                      <div class="mb-3">
                          <label for="image" class="form-label">Select An Image...</label>
                          <input class="form-control" type="file" id="image" name="image">
                          @error('image')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input
                              type="text"
                              class="form-control @error('title') is-invalid @enderror"
                              id="title"
                              name="title"
                              value="{{ old('title') }}"
                          >
                          @error('title')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="mb-3">
                          <select class="form-select" name="category">
                              <option selected>Select a category</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                          @error('category')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="image" class="form-label">Tags</label>
                          <input type="hidden" name="tags" x-ref="tagsData"/>
                          <input type="text" x-model="tagInput" x-on:keydown.enter="insertTag" class="form-control @error('title') is-invalid @enderror"/>
                          @error('tags')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="image" class="form-label text-left">Inserted tags: </label>
                          <p>
                            <template x-for="tag in tags">
                                <span class="badge bg-primary" style="cursor:pointer" @click="removeTag(tag)" x-text="tag"></span>
                            </template>
                          </p>
                      </div>

                      <div class="mb-3 text-center">
                          <button type="submit" class="btn btn-primary">Upload</button>
                      </div>



                  </form>
            </div>

        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function getSource() {
            return {
                tags: [],
                tagInput: '',
                insertTag: function(event) {
                    event.preventDefault();
                    if (this.tagInput != '') {
                        this.tags.push(this.tagInput);
                    }
                    this.tagInput = '';
                },
                removeTag: function(tag) {
                    this.tags.splice(this.tags.indexOf(tag));
                },
                prepareToSubmit: function(event) {
                    event.preventDefault();
                    this.$refs.tagsData.value = this.tags.join(', ');
                    this.$refs.imageForm.submit();
                }

            }
        }


    </script>
@endsection
