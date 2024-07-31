<?php
namespace App\Components\Form;

use App\Libraries\DynamicProperty;
use Permission;
use CMS;

class FormRenderer
{
    use DynamicProperty;

    public $title;
    public $route;
    public $model;
    public $config = [];
    public $hash;
    public $data;

    public function __construct()
    {
        $this->hash = sha1(rand(1, 9999) . uniqid() . time());
    }

    public function renderForm()
    {
        $tabs = [];
        foreach ($this->config as $cfg) {
            if (!in_array($cfg->getTabGroup(), $tabs)) {
                $tabs[] = $cfg->getTabGroup();
            }
        }

        if($this->model->getModel()->isSeoable()) {
            $tabs[] = 'seo';
            $this->config = array_merge($this->config, $this->model->getModel()->seoConfig());
        }

        $param = get_object_vars($this);
        $param['tabs'] = $tabs;
        return view('cms.form.form-renderer', $param)->render();
    }
}