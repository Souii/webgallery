<div x-data="getSource()" x-init="resolveTags()">
    <div class="mb-3" >
        <label for="image" class="form-label">Tags</label>
        <input type="hidden" name="tags" x-ref="tagsData"/>
        <input type="text" x-model="input" x-on:keydown.enter="insertTag" class="form-control @error('title') is-invalid @enderror"/>
        <div class="form-text">
           To add tags to a image, enter the tag name and press the Enter button.
        </div>
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label text-left">Image tags: </label>
        <p>
          <template x-for="tag in tags">
              <span class="badge bg-primary" style="cursor:pointer" @click="removeTag(tag)" x-text="tag"></span>
          </template>
        </p>
    </div>
</div>

<script type="text/javascript">
    function getSource() {
        return {
            tags: [],
            input: '',
            insertTag: function(event) {
                event.preventDefault();
                if (this.input != '') {
                    this.tags.push(this.input);
                    this.retag();
                }
                this.input = '';

            },
            removeTag: function(tag) {
                this.tags.splice(this.tags.indexOf(tag), 1);
                this.retag();
            },
            resolveTags: function() {
                this.tags = "{{ $tags }}".split(', ');
                this.retag();
            },
            retag: function() {
                this.$refs.tagsData.value = this.tags.join(', ');
            },

        }
    }
</script>
