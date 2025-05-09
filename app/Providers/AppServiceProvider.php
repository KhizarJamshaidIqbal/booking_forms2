<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Form;
use App\View\Components\FormSection;
use App\View\Components\FormInput;
use App\View\Components\FormSelect;
use App\View\Components\FormCheckbox;
use App\View\Components\FormRadio;
use App\View\Components\PackageOption;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Blade::component('form', Form::class);
        Blade::component('form-section', FormSection::class);
        Blade::component('form-input', FormInput::class);
        Blade::component('form-select', FormSelect::class);
        Blade::component('form-checkbox', FormCheckbox::class);
        Blade::component('form-radio', FormRadio::class);
        Blade::component('package-option', PackageOption::class);
    }
}
