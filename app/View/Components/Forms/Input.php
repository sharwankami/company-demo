<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $label;
    public $value;
    public $defaultValue;
    public $errorMessage;
    public $options;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $type="input", $value=null, $defaultValue=null, $errorMessage=null, $options=[])
    {
        $this->type=$type;
        $this->name=$name;
        $this->label=$label;
        $this->value=$value;
        $this->defaultValue=$defaultValue;
        $this->errorMessage=$errorMessage;
        $this->options=$options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
