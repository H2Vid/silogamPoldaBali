<?php

namespace App\Base\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function isTranslateable()
    {
        $must_have_method = ['translate', 'translatorInstance', 'clearTranslate', 'outputTranslate'];
        $is_translateable = true;
        foreach ($must_have_method as $method) {
            if (!method_exists($this, $method)) {
                $is_translateable = false;
            }
        }

        if ($is_translateable && !property_exists($this, 'translate_model')) {
            return false;
        }
        return $is_translateable;
    }

    public function isSluggable()
    {
        $must_have_method = ['slugify', 'slugField', 'slugUrl', 'slugTarget'];
        $is_sluggable = true;
        foreach ($must_have_method as $method) {
            if (!method_exists($this, $method)) {
                $is_sluggable = false;
            }
        }
        return $is_sluggable;
    }

    public function isImageGrabable()
    {
        $must_have_method = ['getImageUrl', 'getImagePath'];
        $is_image_grabable = true;
        foreach ($must_have_method as $method) {
            if (!method_exists($this, $method)) {
                $is_image_grabable = false;
            }
        }
        return $is_image_grabable;
    }

    public function isSeoable()
    {
        $must_have_method = ['seoField', 'seoConfig'];
        $is_seoable = true;
        foreach ($must_have_method as $method) {
            if (!method_exists($this, $method)) {
                $is_seoable = false;
            }
        }
        return $is_seoable;
    }
}