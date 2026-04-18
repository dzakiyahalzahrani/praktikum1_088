<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $editUrl;
    public $deleteUrl;

    public function __construct($editUrl, $deleteUrl)
    {
        $this->editUrl = $editUrl;
        $this->deleteUrl = $deleteUrl;
    }

    public function render(): View|Closure|string
    {
        return view('components.action-buttons');
    }
}