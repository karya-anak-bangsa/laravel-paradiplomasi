<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{

    public $title       = '';
    public $action      = '';

    public function __construct($title = '', $action = '')
    {
        $this->title    = $title;
        $this->action   = $action;
    }

    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
