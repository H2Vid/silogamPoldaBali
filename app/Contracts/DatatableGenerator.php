<?php
namespace App\Contracts;

use App\Components\Datatable\DatatableRenderer;
use App\Libraries\DynamicProperty;

abstract class DatatableGenerator 
{
    use DynamicProperty;
    
    public $structure; 

    public function __construct()
    {
        $this->structure = $this->structure();
    }

    abstract public function structure(): DatatableRenderer;
}