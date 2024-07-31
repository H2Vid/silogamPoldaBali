<?php
namespace App\Components\Input;

use App\Libraries\DynamicProperty;

class File
{
    use DynamicProperty;

    public $name;
    public $attr;
    public $path;
    public $value;

    public function build()
    {
        if (strlen($this->name) == 0) {
            $this->name = 'file';
        }
        return view('cms.input.file', get_object_vars($this))->render();
    }
}