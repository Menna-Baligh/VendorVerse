@props([
    'options',
    'type' => 'radio',
    'name' ,
    'id' ,
    'checked' => false ,
    'label' => false
])
@if ($label)
    <label for="{{ $id }}">{{ $label }}</label>
@endif
@foreach ($options as $key => $value)
    <div class="form-check">
        <input type="{{ $type }}" value="{{ $key }}" id="{{ $id }}" name="{{ $name }}" @checked(old($name, $checked) == $key)
        {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}>
        <label for="{{ $id }}" class="form-check-label">{{ $value }}</label>
    </div>
@endforeach

@error($name)
        <span class="text-danger">{{ $message }}</span>
@enderror
