<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputTextarea extends Component
{
    public ?string $label;
    public ?string $name;
    public ?string $value;
    public ?string $placeholder;
    public ?string $hint;
    public int $rows;
    public bool $required;

    public function __construct(
        $label          = null,
        $name           = null,
        $value          = null,
        $placeholder    = null,
        $hint           = null,
        $rows           = 5,
        $required       = false
    ) {
        $this->label            = $label;
        $this->name             = $name;
        $this->value            = $value;
        $this->placeholder      = $placeholder;
        $this->hint             = $hint;
        $this->rows             = $rows;
        $this->required         = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input-textarea');
    }
}
