<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonEdit extends Component
{
    public $route;
    public $entity;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $entity)
    {
        $this->route = $route;
        $this->entity = $entity;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-edit');
    }
}
