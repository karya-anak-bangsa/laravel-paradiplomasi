{{-- resources/views/components/form-input-text.blade.php --}}
@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => null,
    'hint' => null,
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if ($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif
</div>
