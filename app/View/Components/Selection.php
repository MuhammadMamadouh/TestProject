<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Selection extends Component
{
    public $attr, $key,$isRequired,  $item;
     /**
     * Create a new component instance.
     *
     * @return void
     */
     public function __construct( $attr, $key, $isRequired = false, $item = null)
    {
        $this->attr = $attr;
        $this->key = $key;
        $this->item = $item;
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.selection');
    }
}
