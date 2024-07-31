<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Password 
{
    use DynamicProperty;

    public $name;
    public $attr;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'checkbox';
        }
        return view('cms.input.password', get_object_vars($this))->render();
    }
}