<div class="mb-3">
    <label for="image" class="form-label">Select An Image...</label>
    <input class="form-control" type="file" id="image" name="image">
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
