<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowField extends Component
{
    public ?string $label;

    public function __construct($label = null)
    {
        $this->label = $label;
    }

    public function render(): View|Closure|string
    {
        return view('components.show-field');
    }
}
