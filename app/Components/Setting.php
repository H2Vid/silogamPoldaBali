<?php
namespace App\Components;

use App\Models\Setting as Model;
use App\Extenders\SettingGenerator;
use Cache;
use Storage;

class Setting
{
    public $data = [];
    public $formatted = [];

    public function __construct()
    {
        $this->cache_name = config('cms.cache_key.setting', 'APP-CMS-ALLSETTING');
        $this->loadSettingRegistrations();
        $this->setSettingValueFromDb();
        $this->formattedOutput();
    }

    public function all()
    {
        return $this->formatted;
    }

    public function get($key, $fallback = null)
    {
        $key = strtolower($key);
        $value = $this->formatted[$key] ?? null;
        return $value ?? $fallback;
    }

    public function getURL($key, $fallback=null) 
    {
        $get = $this->get($key);
        return $get ? Storage::url($get) : $fallback;
    }

    public function data()
    {
        return collect($this->data)->sortBy('order');
    }

    public function insert($param)
    {
        return Model::insert($param);
    }

    public function deleteWhere($id, $field = 'id')
    {
        return Model::where($field, $id)->delete();
    }

    public function loadSettingRegistrations()
    {
        foreach ((new SettingGenerator)->output() as $group_key => $setting_lists) {
            $this->data[$group_key]['order'] = $setting_lists->getOrder();
            $this->data[$group_key]['title'] = ucwords($group_key);
            if (isset($this->data[$group_key]['items'])) {
                $this->data[$group_key]['items'] = array_merge($this->data[$group_key]['items'], $setting_lists->getItems());
            } else {
                $this->data[$group_key]['items'] = $setting_lists->getItems();
            }
        }
    }

    public function setSettingValueFromDb()
    {
        // load setting data from cache first
        if (Cache::has($this->cache_name)) {
            $this->db_setting = Cache::get($this->cache_name);
        } else {
            $this->db_setting = app('db_setting');
            Cache::set($this->cache_name, $this->db_setting, 86400);
        }

        foreach ($this->data as $group_name => $lists) {
            foreach ($lists['items'] as $item) {
                $grab = $this->db_setting->where('group', $group_name)->where('param', $item->getName())->first();
                if (!empty($grab)) {
                    $item->setValue($grab->default_value);
                }
            }
        }
    }

    public function formattedOutput()
    {
        foreach ($this->data as $group_name => $lists) {
            foreach ($lists['items'] as $item) {
                $setting_key = strtolower($group_name . '.' . $item->getName());
                $setting_value = $item->getValue();
                if ($item->getType() == 'image') {
                    //harus diformat dulu sebelum output setting dapat diformat ke readable data
                }
                $this->formatted[$setting_key] = $setting_value;
            }
        }
        return $this->formatted;
    }

    public function clearCache()
    {
        removeCache('setting');
        // Cache::forget($this->cache_name);
    }

}
