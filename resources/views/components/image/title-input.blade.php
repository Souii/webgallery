<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input
        type="text"
        class="form-control @error('title') is-invalid @enderror"
        id="title"
        name="title"
        value="{{ $value }}"
    >
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
