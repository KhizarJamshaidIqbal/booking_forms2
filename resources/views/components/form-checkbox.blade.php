<div class="checkbox-item">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $name }}_{{ $value }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        class="checkbox-input"
        {{ $attributes }}
    >

    <label for="{{ $name }}_{{ $value }}" class="checkbox-label">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $label }}" class="checkbox-image">
        @endif
        <span>{{ $label }}</span>
    </label>
</div>

<style>
    .checkbox-item {
        margin-bottom: 10px;
        position: relative;
        display: flex;
        align-items: center;
    }

    .checkbox-input {
        margin-right: 10px;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .checkbox-label {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .checkbox-image {
        width: 60px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 4px;
    }
</style>
