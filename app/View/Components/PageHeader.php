<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{

    public $title       = '';
    public $action      = '';
    public $backRoute   = '';

    public function __construct($title = '', $action = '', $backRoute = '')
    {
        $this->title        = $title;
        $this->action       = $action;
        $this->backRoute    = $backRoute;
    }

    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
