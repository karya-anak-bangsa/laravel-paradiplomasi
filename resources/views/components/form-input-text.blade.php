<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input class="form-control border-dark" type="text" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if ($hint)
        <small class="form-hint text-danger">{{ $hint }}</small>
    @endif
</div>
