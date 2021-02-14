@extends('layout.app')

@section('title', 'New Image')

@section('content')
    <div class="row justify-content-center">

        <div class="col-4">

            <div class="card text-center">
              <div class="card-header">
                <h5>Edit Image</h4>
              </div>
              <div class="card-body">
                  <form x-data="getSource()" x-init="resolveTags()" x-on:submit="prepareToSubmit" x-ref="imageForm" action="{{ route('image.update', $image) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                      <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input
                              type="text"
                              class="form-control @error('title') is-invalid @enderror"
                              id="title"
                              name="title"
                              value="{{ $image->title }}"
                          >
                          @error('title')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{ $image->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="mb-3">
                          <select class="form-select" name="category">
                            @foreach ($categories as $category)
                              <option
                              value="{{ $category->id }}"
                                @if ($category->id == $image->category_id)
                                    {{ 'selected' }}
                                @endif
                              >
                                  {{ $category->name }}
                              </option>
                            @endforeach
                          </select>
                          @error('category')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label for="image" class="form-label">Tags</label>
                          <input type="hidden" name="tags" x-ref="tagsData" value="{{ $tags }}"/>
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

                      <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Edit</button>
                      </div>



                  </form>
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
                    this.tags.splice(this.tags.indexOf(tag), 1);
                },
                prepareToSubmit: function(event) {
                    event.preventDefault();
                    this.$refs.tagsData.value = this.tags.join(', ');
                    this.$refs.imageForm.submit();
                },
                resolveTags: function() {
                    this.tags = "{{ $tags }}".split(', ');
                }

            }
        }


    </script>
@endsection
