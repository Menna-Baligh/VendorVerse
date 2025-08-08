<div class="form-group">
                        <x-form.input id="name" name="name" :value="$category->name" label="Category Name"/>
                    </div>
                    <div class="form-group">
                        <x-form.textarea id="description" name="description" :value="$category->description" label="Description"/>
                    </div>
                    <div class="form-group">
                        <x-form.radio id="status" name="status" :checked="$category->status" label="Status" :options="['active' => 'Active', 'archived' => 'Archived']"/>
                    </div>
                    <div class="form-group">
                        <x-form.input type="file" id="image" name="image" label="Image" accept="image/*"/>
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
