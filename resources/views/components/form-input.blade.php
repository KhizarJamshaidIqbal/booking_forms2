<div class="form-group">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="required">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ $value ?? '' }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
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

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .required {
        color: red;
    }

    .form-control:focus {
        border-color: #15BFBF;
        outline: none;
    }

    input[type="date"].form-control {
        padding: 8px;
    }
</style>
