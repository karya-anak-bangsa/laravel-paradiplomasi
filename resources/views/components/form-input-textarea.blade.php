<div class="mb-3">
    <label class="form-label" for="{{ $name }}">@if ($required)<span class="text-danger">*</span>@endif{{ $label }}</label>
    <textarea class="form-control border-dark {{ $wysiwyg ? 'wysiwyg' : '' }}" name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if ($hint)
        <small class="form-text">{{ $hint }}</small>
    @endif
</div>
