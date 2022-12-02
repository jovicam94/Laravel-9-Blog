<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Updated extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $date;
    public $name;
    public $type;
    public function __construct($date, $name=null, $type=null)
    {
        $this->date = $date;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.updated');
    }
}
