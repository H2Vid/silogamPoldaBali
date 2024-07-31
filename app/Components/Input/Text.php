<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Text 
{
    use DynamicProperty;

    public $name;
    public $data; // only filled when we need custom "data" attribute
    public $type;
    public $attr;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'text';
        }
        return view('cms.input.text', get_object_vars($this))->render();
    }
}