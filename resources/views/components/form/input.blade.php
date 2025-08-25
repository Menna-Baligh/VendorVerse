@props(['type'=> 'text', 'name', 'id', 'value'=> '' , 'label' => false])

@if($label)
    <label for="{{ $id }}">{{ $label }}</label>
@endif

<input type="{{ $type }}"
        id="{{ $id ?? '' }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
>
@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
