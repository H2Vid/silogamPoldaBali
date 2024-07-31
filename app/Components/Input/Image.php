<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class Image 
{
    use DynamicProperty;

    public $name;
    public $attr;
    public $path;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'image';
        }
        return view('cms.input.image', get_object_vars($this))->render();
    }
}