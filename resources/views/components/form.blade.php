<div class="form-container">
    @if($title)
    <h1 class="form-title">{{ $title }}</h1>
    @endif

    <form {{ $attributes }}>
        {{ $slot }}

        <button type="submit" class="book-now-btn">
            {{ $submitButtonText }}
        </button>
    </form>
</div>

<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .form-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .book-now-btn {
        background-color: #15BFBF;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        margin: 20px auto;
    }

    .book-now-btn:hover {
        background-color: #12adad;
    }
</style>
