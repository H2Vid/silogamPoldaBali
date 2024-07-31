<?php
namespace App\Components\Datatable;

use App\Libraries\DynamicProperty;

class DatatableField
{
    use DynamicProperty;

    public $field;
    public $label;
    public $searchable = true;
    public $orderable = true;
}