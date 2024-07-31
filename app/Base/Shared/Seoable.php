<?php
namespace App\Base\Shared;

use App\Components\Form\FormField;

trait Seoable 
{
    public function seoField()
    {
        return 'seo';
    }

    public function getSeoField($field_name, $lang=null)
    {
        $seo_data = json_decode($this->{$this->seoField()}, true);
        if (method_exists($this, 'outputTranslate')) {
            $seo_data = json_decode($this->outputTranslate($this->seoField(), $lang), true);
        }
        return $seo_data[$field_name] ?? null;
    }

    public function seoConfig()
    {
        $is_translatable = method_exists($this, 'translate');

        return [
            (new FormField)->setField('seo[title]')
                ->setLabel('SEO Title')
                ->setTabGroup('seo')
                ->setType('text')
                ->setColumn(9)
                ->setTranslateable($is_translatable)
                ->setValue(function($item) use($is_translatable) {
                    if (!$item) {
                        return null;
                    }
                    if (!$is_translatable) {
                        return $item->getSeoField('title');
                    }
                    $out = [];
                    foreach (config('cms.lang.available') as $langcode => $langname) {
                        $out[$langcode] = $item->getSeoField('title', $langcode);
                    }
                    return $out;
                })
                ->use(),

            (new FormField)->setField('seo[image]')
                ->setLabel('SEO Image')
                ->setType('image')
                ->setTabGroup('seo')
                ->setColumn(3)
                ->setValue(function($item) use($is_translatable) {
                    if (!$item) {
                        return null;
                    }
                    return $item->getSeoField('image');
                })
                ->use(),

            (new FormField)->setField('seo[description]')
                ->setLabel('SEO Description')
                ->setType('textarea')
                ->setTabGroup('seo')
                ->setColumn(12)
                ->setTranslateable($is_translatable)
                ->setValue(function($item) use($is_translatable) {
                    if (!$item) {
                        return null;
                    }
                    if (!$is_translatable) {
                        return $item->getSeoField('description');
                    }
                    $out = [];
                    foreach (config('cms.lang.available') as $langcode => $langname) {
                        $out[$langcode] = $item->getSeoField('description', $langcode);
                    }
                    return $out;
                })
                ->use(),
            (new FormField)->setField('seo[keyword]')
                ->setLabel('SEO Keywords')
                ->setType('tags')
                ->setTabGroup('seo')
                ->setColumn(12)
                ->setTranslateable($is_translatable)
                ->setValue(function($item) use($is_translatable) {
                    if (!$item) {
                        return null;
                    }
                    if (!$is_translatable) {
                        return $item->getSeoField('keyword');
                    }
                    $out = [];
                    foreach (config('cms.lang.available') as $langcode => $langname) {
                        $out[$langcode] = $item->getSeoField('keyword', $langcode);
                    }
                    return $out;
                })
                ->use(),

        ];
    }
}