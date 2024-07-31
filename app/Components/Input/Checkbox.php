<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Checkbox 
{
    use DynamicProperty;

    public $name;
    public $type;
    public $lists;
    public $attr;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'checkbox';
        }
        if (is_callable($this->lists)) {
            $this->lists = call_user_func($this->lists);
        }
        if (empty($this->lists)) {
            $this->lists = [];
        }
        return view('cms.input.checkbox', get_object_vars($this))->render();
    }
}