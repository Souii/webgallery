@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

        @if(session('success'))
            <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                {{ session('success') }}
            </div>
        @endif

    <div class="row justify-content-center" x-data="getSource()" x-init="loadImages()">
        <h3 class="text-center my-4">Dashboard</h3>

        <div class="col-12 mb-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <form class="row g-3">
                      <div class="col-7">
                        <input class="form-control me-2" x-model="searchTag" type="search" placeholder="Tag, e.g. Artorias" aria-label="Search">
                      </div>
                      <div class="col-3">
                          <select class="form-select" x-model="category" aria-label="Default select example">
                              <option value="" selected>Select a category</option>
                              @foreach ($categories as $category)
                                  <option value="{{ $category->name }}">{{ $category->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-auto">
                        <button class="btn btn-outline-secondary" @click="search">Search</button>
                      </div>
                    </form>
                </div>

                <div class="col-1">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn" href="{{ route('image.create') }}">Upload</a>
                        </div>
                        <div class="col-6">
                            <a class="btn" href="{{ route('category.index') }}">Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">

                <div id="myModal" class="modal">
                  <span class="close" @click="close()">&times;</span>
                  <img class="modal-content" id="img01">
                  <div id="caption"></div>
                </div>

                <template x-for="image in images" :key="image.id">
                    <div class="col-2 float">
                        <div class="card mb-3" style="font-size:14px;">
                          <img x-bind:src="getPath(image.thumbnail)" class="card-img-top thumbnail" @click="show(image)" alt="">
                          <span x-on:click="deleteImage(image)" class="closebtn">&times;</span>
                          <div class="card-body text-center">
                            <p class="card-title" x-text="image.title" style="font-weight: bold"></p>
                            <p class="card-text" x-text="image.description"></p>
                            <p class="card-text">
                                <template x-for="tag in image.tags" >
                                    <small class="text-muted">
                                        <span class="badge bg-primary" x-text="tag.name"></span>
                                    </small>
                                </template>
                            </p>

                            <div class="row">
                                <div class="offset-8 col-4">
                                    <a x-bind:href="`/admin/image/${image.id}/edit`" class="btn">Edit</a>
                                </div>
                            </div>

                          </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="col-2 my-3">
            <p>
                <button class="btn btn-outline-secondary form-control" @click="loadMore">Load More</button>
            </p>
        </div>
    </div>
@endsection

@section('script')
    <script>

        function getSource() {
            return {
                images: [],
                searchTag: '',
                category: '',
                number: 1,
                loadImages: function () {
                    axios.get('/api/images', {
                        params: {
                            category: this.category,
                            tag: this.searchTag,
                            number: this.number
                        }
                    })
                    .then(response => {
                        this.images = response.data;
                    });
                },
                search: function(event) {
                    event.preventDefault();
                    this.number = 1;
                    this.loadImages();
                },
                show: function(image) {
                    var modal = document.getElementById("myModal");

                    var modalImg = document.getElementById("img01");
                    var captionText = document.getElementById("caption");
                    modal.style.display = "block";
                    modalImg.src = this.getPath(image.original);
                    captionText.innerHTML = image.title;
                },
                close: function() {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "none";
                },
                getPath: function(path) {
                    return "/storage/" + path;
                },
                loadMore: function() {
                    this.number += 1;
                    this.loadImages();
                },
                deleteImage: function(image) {
                    axios.delete(`/admin/image/${image.id}`);
                    this.loadImages();
                },
            }
        }
    </script>
@endsection