<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Subtasks extends Component
{
    public $subtasks;

    /**
     * Create a new component instance.
     *
     * @param $subtasks
     */
    public function __construct($subtasks)
    {
        $this->subtasks = $subtasks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.subtasks');
    }
}
