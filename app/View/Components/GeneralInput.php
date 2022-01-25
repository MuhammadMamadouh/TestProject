<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GeneralInput extends Component
{
    public $type, $attr, $isRequired, $item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $type,  $attr,  $isRequired = false,  $item = null)
    {
        $this->type = $type;
        $this->attr = $attr;
        $this->isRequired = $isRequired;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.general-input');
    }
}
