<?php
namespace App\Contracts;

use App\Components\Form\FormRenderer;
use App\Libraries\DynamicProperty;

abstract class FormGenerator 
{
    use DynamicProperty;
    
    public $structure; 

    public function __construct()
    {
        $this->structure = $this->structure();
    }

    abstract public function structure(): FormRenderer;
}