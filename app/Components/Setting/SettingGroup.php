<?php
namespace App\Components\Setting;

use App\Components\Setting\SettingItem;
use App\Libraries\DynamicProperty;

// class instance utk group setting item
class SettingGroup
{
    use DynamicProperty;

    private $title;
    private $order = 1000;
    private $items;

    public function __construct($title = null, $item = null)
    {
        $this->setTitle($title);
        if (is_array($item)) {
            $this->addItems($item);
        } else if ($item instanceof SettingItem) {
            $this->addItem($item);
        }
    }

    public function setTitle($title = null)
    {
        $this->title = strtolower($title);
        return $this;
    }

    public function setOrder($order = 1)
    {
        $this->order = $order;
        return $this;
    }

    public function addItem(SettingItem $instance)
    {
        $this->items[] = $instance;
        return $this;
    }

    public function addItems($arr = [])
    {
        foreach ($arr as $item) {
            $this->addItem($item);
        }
        return $this;
    }
}
