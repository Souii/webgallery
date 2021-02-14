@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center" x-data="getSource()" x-init="loadImages()">
        <h3 class="text-center my-4">Gallery</h3>

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
            </div>
        </div>

        <div class="col-12">
            <div class="row">

                <div class="masonry">
                    <template x-for="image in images" :key="image.id">
                        <div class="item text-center" style="font-size:15px;">
                            <img x-bind:src="getPath(image.thumbnail)" @click="show(image)">

                            <p class="mt-2 mb-0" x-text="image.title" style="font-weight: bold"></p>
                            <p class="" x-text="image.description"></p>
                            <p class="my-0">
                                <template x-for="tag in image.tags" >
                                    <small class="text-muted">
                                        <span class="badge bg-primary" x-text="tag.name"></span>
                                    </small>
                                </template>
                            </p>
                            <p class="text-right my-0"><a href="#" class="btn">Share</a></p>

                        </div>
                    </template>
                </div>

                <div id="myModal" class="modal">
                  <span class="close" @click="close()">&times;</span>
                  <img class="modal-content" id="img01">
                  <div id="caption"></div>
                </div>
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
                }
            }
        }


    </script>
@endsection
