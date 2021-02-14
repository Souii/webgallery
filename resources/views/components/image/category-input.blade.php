<div class="mb-3">
    <select class="form-select" name="category">
      @foreach ($categories as $category)
        <option
        value="{{ $category->id }}"
          @if ($selected === $category->id)
            selected
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
