<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Textarea
{
    use DynamicProperty;

    public $name;
    public $data;
    public $attr;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'text';
        }
        return view('cms.input.textarea', get_object_vars($this))->render();
    }
}