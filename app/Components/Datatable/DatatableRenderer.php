<?php
namespace App\Components\Datatable;

use App\Libraries\DynamicProperty;
use App\Components\Datatable\DatatableProcessor;
use Permission;

class DatatableRenderer
{
    use DynamicProperty;
    use DatatableProcessor;

    public $title;
    public $route;
    public $default_sort_by;
    public $default_sort_dir;
    public $batch_delete_route;
    public $model;
    public $config = [];
    public $search_handle;
    public $hash;
    public $table_data;

    public function __construct()
    {
        $this->hash = sha1(rand(1, 9999) . uniqid() . time());
    }

    public function renderTable()
    {
        return view('cms.datatable.table-renderer', get_object_vars($this))->render();
    }

    public function renderScript()
    {
        return view('cms.datatable.asset-generator', get_object_vars($this))->render();
    }

}