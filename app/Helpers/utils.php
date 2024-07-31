<?php
function arrayToHtmlProp($arr = [], $ignore_key = [])
{
    if (empty($arr)) {
        return '';
    }
    $out = '';
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            $value = implode(' ', $value);
        } elseif (is_object($value)) {
            $value = json_encode($value);
        }

        if (in_array(strtolower($key), $ignore_key)) {
            continue;
        }

        $out .= $key . '="' . $value . '" ';
    }

    return $out;
}

// will remove stored cached for key defined in cms setting
function removeCache($key)
{
    if (strlen($key) == 0) {
        // clear all cache
        \Artisan::call('cache:clear');
        return true;
    }
    $cache_key = config('cms.cache_key.' . $key);
    if ($cache_key) {
        \Cache::forget($cache_key);
        return true;
    }

    // cache key not found
    return false;
}

function slugify($input, $delimiter = '-')
{
    $input = preg_replace("/[^a-zA-Z0-9- &]/", "", $input);
    $string = strtolower(str_replace(' ', $delimiter, $input));
    if (strpos($string, '&') !== false) {
        $string = str_replace('&', 'and', $string);
    }
    return $string;
}

function prettify($slug, $delimiter = '-')
{
    return str_replace($delimiter, ' ', $slug);
}
