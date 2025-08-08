<div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text"
                                class="form-control"
                                id="name" name="name"
                                @class([
                                    'is-invalid' => $errors->has('name'),
                                    'form-control'
                                ])
                                value="{{ old('name', $category->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="active" id="is_active" name="status" @checked(old('status', $category->status) == 'active')>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="archived" id="is_inactive" name="status" @checked(old('status', $category->status) == 'archived')>
                            <label class="form-check-label" for="is_inactive">Archived</label>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" alt="" width="100">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent Category</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="">None</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" @selected($parent->id == old('parent_id', $category->parent_id))>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ $button_name ?? 'Add' }}</button>
                    </div>
