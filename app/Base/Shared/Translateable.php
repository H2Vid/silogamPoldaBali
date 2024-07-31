<?php
namespace App\Base\Shared;

use CMS;

trait Translateable
{
    public function translate()
    {
        return $this->hasMany($this->translate_model, 'main_id');
    }

    public function translatorInstance()
    {
        $instance = app($this->translate_model);
        $instance->main_id = $this->getKey();
        return $instance;
    }

    public function clearTranslate()
    {
        return app($this->translate_model)->where('main_id', $this->getKey())->delete();
    }

    public function outputTranslate($field, $lang = null)
    {
        $fallback = $this->{$field};
        if (empty($lang)) {
            $lang = CMS::currentLang();
        }
        if (method_exists($this ,'translate')) {
            $grab = $this->translate->where('lang', $lang)->first();
        }
        return $grab->{$field} ?? $fallback;
    }

    public function storeTranslate($data=[]) 
    {
        $current_datas = app($this->translate_model)->where('main_id', $this->getKey())->get();
        $translator_fillable = $this->translatorInstance()->getFillable();
        foreach (CMS::langs() as $langcode => $langname) {
            if (!isset($data[$langcode])) {
                // do nothing if no data to be handled
                continue; 
            }

            $single = $current_datas->where('lang', $langcode)->first();
            if (empty($single)) {
                $single = $this->translatorInstance();
                $single->lang = $langcode;
            }

            $ok = false;
            foreach ($data[$langcode] ?? [] as $field => $value) {
                if (in_array($field, $translator_fillable)) {
                    $single->{$field} = $value;
                    $ok = true;
                }
            }
            if ($ok) {
                $single->save();
            }
        }
    }
}
