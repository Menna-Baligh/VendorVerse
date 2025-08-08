@props(['name', 'id', 'value' , 'label' => false])

@if($label)
    <label for="{{ $id }}">{{ $label }}</label>
@endif

<textarea  id="{{ $id }}"
            name="{{ $name }}"
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name) , 'row'=> 3]) }}>
    {{ old($name, $value) }}
</textarea>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
