<div class="mb-3">
  <label for="description" class="form-label">Description</label>
  <textarea class="form-control" id="description" rows="3" name="description">{{ $value }}</textarea>
  @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>
