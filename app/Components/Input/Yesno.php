<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Yesno
{
    use DynamicProperty;

    public $name;
    public $label;
    public $attr;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'yesno';
        }
        return view('cms.input.yesno', get_object_vars($this))->render();
    }
}