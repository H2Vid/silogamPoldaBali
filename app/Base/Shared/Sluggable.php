<?php
namespace App\Base\Shared;

use Exception;

trait Sluggable
{
    public function slugify($text_tobe)
    {
        $current_id = $this->getKey();
        $text_tobe = slugify(prettify($text_tobe));

        // check if text_tobe is already exists in current model slugField()

        $grab = $this->where($this->slugField(), $text_tobe);
        if ($current_id) {
            $grab = $grab->where($this->getKeyName(), '<>', $current_id);
        }

        $grabbed = $grab->count();
        if ($grabbed > 0) {
            $random = substr(sha1(rand(1, 999999) . uniqid() . time()), 0, 10);
            $text_tobe = $text_tobe . '-' . $random;
        }

        $this->{$this->slugField()} = $text_tobe;
        return $this;
    }

    // slugField() method can be overriden if you want to define the custom slug field name
    public function slugField()
    {
        return 'slug';
    }

    // slugUrl() method can be overriden if you want to define the custom url prefix previewed in CMS
    public function slugUrl($path=null)
    {
        return config('app.url') . (strlen($path) > 0 ? '/'. $path : '');
    }
}