<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public array $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $placeholder = '',
        public string $selected = '',
        public bool $required = false,
        array $options = []
    ) {
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-select');
    }
}
