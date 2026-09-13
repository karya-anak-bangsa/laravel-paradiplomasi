<div class="mb-3">

    <label class="form-label" for="{{ $name }}">{{ $label }}</label>

    <select class="form-select border-dark" name="{{ $name }}" id="{{ $name }}">
        <option value="" selected>{{ $placeholder }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

    @if ($hint)
        <small class="form-text text-danger">{{ $hint }}</small>
    @endif

</div>
