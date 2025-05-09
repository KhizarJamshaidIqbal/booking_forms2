<div class="radio-item"
    x-data="{
        quantity: 1,
        isSelected: {{ $checked ? 'true' : 'false' }},
        checkSelected() {
            this.isSelected = document.getElementById('{{ $name }}_{{ $value }}').checked;
        }
    }"
    x-init="$watch('isSelected', value => {
        if (value) {
            $dispatch('option-selected', {name: '{{ $name }}', value: '{{ $value }}', quantity: quantity});
        }
    })"
    @radio-selected.window="if ($event.detail.name === '{{ $name }}' && $event.detail.value !== '{{ $value }}') { isSelected = false; }"
>
    <input
        type="radio"
        name="{{ $name }}"
        id="{{ $name }}_{{ $value }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        class="radio-input"
        {{ $attributes }}
        @if(isset($price)) data-price="{{ $price }}" @endif
        @change="isSelected = $event.target.checked;
                $dispatch('radio-selected', {name: '{{ $name }}', value: '{{ $value }}'});
                $dispatch('option-selected', {name: '{{ $name }}', value: '{{ $value }}', quantity: quantity})"
    >

    <label for="{{ $name }}_{{ $value }}" class="radio-label" :class="{ 'selected': isSelected }">
        <div class="radio-circle">
            <div class="radio-dot"></div>
        </div>
        <span class="radio-text">{{ $label }}</span>
        @if ($price)
            <span class="radio-price">+ AED {{ $price }}</span>
        @endif
        @if (isset($quantityLabel) && !empty($quantityLabel))
            <span class="quantity-label">{{ $quantityLabel }}</span>
        @endif
    </label>

    <div class="quantity-counter" x-show="isSelected" x-cloak>
        <button type="button" class="qty-btn minus-btn" @click="quantity > 1 ? quantity-- : 1; $dispatch('quantity-changed', {option: '{{ $name }}', value: '{{ $value }}', quantity: quantity})">-</button>
        <input type="text" name="quantity_{{ $name }}_{{ $value }}" x-model="quantity" class="qty-input" readonly>
        <button type="button" class="qty-btn plus-btn" @click="quantity++; $dispatch('quantity-changed', {option: '{{ $name }}', value: '{{ $value }}', quantity: quantity})">+</button>
        <button type="button" class="remove-btn" @click="document.getElementById('{{ $name }}_{{ $value }}').checked = false; isSelected = false; $dispatch('option-removed', {name: '{{ $name }}', value: '{{ $value }}'})">×</button>
    </div>
</div>

<style>
    .radio-item {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        padding: 8px 0;
        justify-content: space-between;
    }

    .radio-input {
        display: none;
    }

    .radio-label {
        cursor: pointer;
        display: flex;
        align-items: center;
        flex-grow: 1;
    }

    .radio-label.selected {
        font-weight: bold;
    }

    .radio-circle {
        width: 18px;
        height: 18px;
        border: 2px solid #ccc;
        border-radius: 50%;
        margin-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .radio-input:checked + .radio-label .radio-circle {
        border-color: #15BFBF;
    }

    .radio-dot {
        width: 10px;
        height: 10px;
        background-color: #15BFBF;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .radio-input:checked + .radio-label .radio-dot {
        opacity: 1;
    }

    .radio-text {
        font-size: 14px;
    }

    .radio-image {
        width: 60px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 4px;
    }

    .radio-price {
        color: #FF4433;
        margin-left: 8px;
        font-weight: bold;
        font-size: 14px;
    }

    .quantity-counter {
        display: flex;
        align-items: center;
        border: 1px solid #15BFBF;
        border-radius: 4px;
        overflow: hidden;
        margin-left: auto;
    }

    .qty-btn {
        background-color: white;
        border: none;
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
        color: #15BFBF;
    }

    .qty-input {
        width: 30px;
        height: 30px;
        text-align: center;
        border: none;
        border-left: 1px solid #15BFBF;
        border-right: 1px solid #15BFBF;
        font-size: 14px;
    }

    .remove-btn {
        width: 30px;
        height: 30px;
        background-color: white;
        border: none;
        border-radius: 50%;
        border: 1px solid #ccc;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 5px;
        color: #666;
    }

    .quantity-label {
        margin-left: 5px;
        font-size: 13px;
        color: #666;
    }
</style>
