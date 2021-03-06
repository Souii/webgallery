@if(session('success'))
    <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ session('success') }}
    </div>
@endif

<div class="row justify-content-center" x-data="getSource()" x-init="loadImages()">
    <h3 class="text-center my-4">{{ $header }}</h3>

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

            @if($admin)
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
            @endif
        </div>
    </div>

    <div class="col-12">
        <div class="row">

            <div id="myModal" class="modal">
              <span class="close" @click="close()">&times;</span>
              <img class="modal-content" id="img01">
              <div id="caption"></div>
            </div>

            <div class="masonry">
                <template x-for="image in images" :key="image.id">
                    <div class="item text-center" style="font-size:15px;">
                        <p style="position: relative">
                            <img x-bind:src="getPath(image.thumbnail)" @click="show(image)">
                            @if($admin)
                                <span x-on:click="deleteImage(image)" class="closebtn">&times;</span>
                            @endif
                        </p>
                        <p class="mt-2 mb-0" x-text="image.title" style="font-weight: bold"></p>
                        <p class="" x-text="image.description"></p>
                        <p class="my-0">
                            <template x-for="tag in image.tags" >
                                <small class="text-muted">
                                    <span class="badge bg-primary" x-text="tag.name"></span>
                                </small>
                            </template>
                        </p>
                        @if($admin)
                            <p class="text-right my-0">
                                <a x-bind:href="`/admin/image/${image.id}/edit`" class="btn">Edit</a>
                            </p>
                        @else
                            <p class="text-right my-0">
                                <a href="#" class="btn">Share</a>
                            </p>
                        @endif

                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class="col-2 my-3">
        <p>
            <button class="btn btn-outline-secondary form-control" @click="loadMore">Load More</button>
        </p>
    </div>
</div>

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
                return "/" + path;
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
