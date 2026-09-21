<div class="mb-3">
    <label class="form-label" for="{{ $name }}">@if ($required)<span class="text-danger">*</span>@endif{{ $label }}</label>
    <input class="form-control border-dark" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if ($hint)
        <small class="form-text">{{ $hint }}</small>
    @endif
</div>
