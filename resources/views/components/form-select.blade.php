<div class="form-group">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="required">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select"
        {{ $required ? 'required' : '' }}
        {{ isset($attributes) && !is_array($attributes) ? $attributes : '' }}
    >
        @if ($placeholder)
            <option value="" disabled {{ $selected ? '' : 'selected' }}>{{ $placeholder }}</option>
        @endif

        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
</div>

<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: white;
    }

    .required {
        color: red;
    }

    .form-select:focus {
        border-color: #15BFBF;
        outline: none;
    }
</style>
