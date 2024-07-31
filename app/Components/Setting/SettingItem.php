<?php
namespace App\Components\Setting;

use App\Libraries\DynamicProperty;
use Exception;

// class instance utk single setting item
class SettingItem
{
    use DynamicProperty;

    private $name;
    private $title;
    private $type;
    private $config = [];
    private $value;

    public function __construct($name, $title, $type = 'text', $config = [], $default_value = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->setType($type, $config);
        $this->value = $default_value;
    }

    public function setType($type = 'text', $config = [])
    {
        $available_type = ['text', 'textarea', 'number', 'email', 'tel', 'select', 'color', 'yesno', 'image'];
        $type = strtolower($type);
        if (!in_array($type, $available_type)) {
            throw new Exception('Undefined "' . $type . '" setting item type.');
        }

        $this->type = $type;
        $this->setConfig($config);
        return $this;
    }

    public function setConfig($config = [])
    {
        $this->config = array_merge($this->config, $config);
        if ($this->type == 'select' && !isset($this->config['lists'])) {
            throw new Exception('You need to define the setting "lists" config for input type select_static');
        }
        return $this;
    }

}
