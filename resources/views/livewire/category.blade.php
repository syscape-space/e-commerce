<div>
        <div class="form-group">
            
                <label for="status">Select Category</label>
                <select name="category" class="form-control @error('category') is-invalid @enderror"  wire:model="selectedCategory">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
        </div>

        @if (!is_null($subCategories))
        <div class="form-group">
            
                <label for="status">Select a SubCategroy</label>
                <select name="subcategory" class="form-control @error('subcategory') is-invalid @enderror"  wire:model="selectedSubCategory">
                    <option value="">Select a SubCategroy</option>
                    @foreach ($subCategories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
        </div>
        @endif
</div>
