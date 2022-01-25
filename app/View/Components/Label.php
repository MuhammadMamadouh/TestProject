<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    public $attr, $isRequired, $text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attr, $text, $isRequired = false)
    {
        $this->attr = $attr;
        $this->isRequired = $isRequired;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.label');
    }
}
