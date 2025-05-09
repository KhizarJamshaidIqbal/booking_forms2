<div class="package-item" x-data="{ quantity: 1 }">
    <div class="package-selection">
        <input
            type="radio"
            name="{{ $name }}"
            id="{{ $name }}_{{ $value }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            class="package-radio"
            {{ $attributes }}
            @if(isset($price)) data-price="{{ $price }}" @endif
        >

        <label for="{{ $name }}_{{ $value }}" class="package-label">
            <div class="checkbox-container">
                <div class="checkbox-inner"></div>
            </div>
            @if ($image)
                <img src="{{ $image }}" alt="{{ $label }}" class="package-image">
            @endif
            <div class="package-details">
                <span class="package-title">{{ $label }}</span>
                @if ($duration)
                    <span class="package-duration">{{ $duration }}</span>
                @endif
            </div>
            @if ($price)
                <span class="package-price">+ AED {{ $price }} ({{ $quantityLabel }})</span>
            @endif
        </label>
    </div>

    <div class="quantity-control" x-show="$el.closest('.package-item').querySelector('input').checked">
        <button type="button" class="qty-btn qty-decrease" @click="quantity > 1 ? quantity-- : 1; $dispatch('quantity-changed', {value: '{{ $value }}', quantity: quantity})">-</button>
        <input type="text" name="quantity_{{ $value }}" x-model="quantity" class="qty-input" readonly>
        <button type="button" class="qty-btn qty-increase" @click="quantity++; $dispatch('quantity-changed', {value: '{{ $value }}', quantity: quantity})">+</button>
        <button type="button" class="qty-remove" @click="quantity = 0; $dispatch('quantity-changed', {value: '{{ $value }}', quantity: 0})">&times;</button>
    </div>
</div>

<style>
    .package-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
    }

    .package-selection {
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .package-radio {
        display: none;
    }

    .checkbox-container {
        width: 50px;
        height: 25px;
        display: flex;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 3px;
        position: relative;
        margin-right: 10px;
        overflow: hidden;
        background-color: #f5f5f5;
    }

    .checkbox-inner {
        position: absolute;
        width: 25px;
        height: 21px;
        background-color: white;
        border-right: 1px solid #ddd;
        left: 0;
        transition: all 0.2s ease;
    }

    .package-radio:checked + .package-label .checkbox-container {
        border-color: #15BFBF;
        background-color: #15BFBF;
    }

    .package-radio:checked + .package-label .checkbox-inner {
        transform: translateX(25px);
        border-left: 1px solid #ddd;
        border-right: none;
    }

    .package-label {
        cursor: pointer;
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .package-image {
        width: 60px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 4px;
    }

    .package-details {
        display: flex;
        flex-direction: column;
    }

    .package-title {
        font-weight: bold;
    }

    .package-duration {
        font-size: 0.9em;
        color: #666;
    }

    .package-price {
        color: #FF4433;
        margin-left: auto;
        font-weight: bold;
        padding-right: 10px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .qty-btn {
        background-color: #f5f5f5;
        border: none;
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
    }

    .qty-input {
        width: 40px;
        height: 30px;
        text-align: center;
        border: none;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }

    .qty-remove {
        background-color: #f5f5f5;
        border: none;
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
        margin-left: 5px;
    }
</style>
