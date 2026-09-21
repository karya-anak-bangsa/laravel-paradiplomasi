<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputText extends Component
{
    public ?string $label;

    public ?string $name;

    public ?string $type;

    public ?string $value;

    public ?string $placeholder;

    public ?string $hint;

    public ?bool $required;

    public function __construct(
        $label = null,
        $name = null,
        $type = 'text',
        $value = null,
        $placeholder = null,
        $hint = null,
        $required = false,
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->hint = $hint;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input-text');
    }
}
