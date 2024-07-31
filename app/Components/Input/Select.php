<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Select 
{
    use DynamicProperty;

    public $name;
    public $lists;
    public $attr;
    public $is_multiple;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'text';
        }
        if (is_callable($this->lists)) {
            $this->lists = call_user_func($this->lists);
        }
        if (empty($this->lists)) {
            $this->lists = [];
        }
        return view('cms.input.select', get_object_vars($this))->render();
    }
}