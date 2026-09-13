<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputSelect extends Component
{
    public function __construct(
        public string $label,
        public string $name,
        public array $options = [],
        public ?string $value = null,
        public ?string $placeholder = null,
        public ?string $hint = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.form-input-select');
    }
}
