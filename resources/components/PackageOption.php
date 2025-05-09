<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PackageOption extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $value = '',
        public bool $checked = false,
        public string $image = '',
        public string $price = '',
        public string $duration = '',
        public string $quantityLabel = ''
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.package-option');
    }
}
