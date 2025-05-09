@props(['title', 'initialOpen' => false])

<div class="form-section" x-data="{ open: {{ $initialOpen ? 'true' : 'false' }} }">
    <div class="form-section-header" @click="open = !open">
        <h2>{{ $title }}</h2>
        <span class="toggle-icon" :class="{ 'open': open }">
            <span x-text="open ? '▲' : '▼'"></span>
        </span>
    </div>

    <div class="form-section-content" x-show="open" x-transition>
        {{ $slot }}
    </div>
</div>

<style>
    .form-section {
        margin-bottom: 15px;
    }

    .form-section-header {
        background-color: #15BFBF;
        color: white;
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .form-section-header h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .toggle-icon {
        transition: transform 0.2s;
        font-size: 14px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
    }

    .form-section-content {
        background-color: white;
        padding: 15px;
        border: 1px solid #ddd;
        border-top: none;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }
</style>
