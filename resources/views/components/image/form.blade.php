<div class="row justify-content-center">

    <div class="col-4">

            <div class="card text-center">
              <div class="card-header">
                <h5>{{ ucfirst($action) }} An Image</h4>
              </div>

              <div class="card-body">
                  <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @if ($action == 'update')
                          @method('PUT')
                      @endif

                      @if ($action == 'create')
                          <x-image.image-input/>
                      @endif
                      
                      <x-image.title-input :value="$imageData['title'] ?? ''"/>
                      <x-image.description-input :value="$imageData['description'] ?? ''"/>
                      <x-image.category-input :categories="$categories" :selected="$imageData['category'] ?? ''"/>
                      <x-image.tag-input :tags="$imageData['tags'] ?? ''"/>
                      <x-image.submit-button :name="strtoupper($action)"/>

                  </form>
              </div>

        </div>
    </div>
</div>
