<?php

function adminURL($target)
{
    $admin_prefix = config('cms.admin_prefix');
    return url($admin_prefix . '/' . $target);
}

function titleGenerate($title=null)
{
    return (strlen($title) > 0 ? $title .' - ' : '') . Setting::get('general.title', config('cms.site_title'));
}

function menuUrl($menu_data=[])
{
    if (isset($menu_data['url'])) {
        if (substr($menu_data['url'], 0, 4) == 'http') {
            return $menu_data['url'];
        } else if (strlen($menu_data['url']) > 1) {
            return url($menu_data['url']);
        } else {
            return '#';
        }
    } else if (isset($menu_data['route'])) {
        return route($menu_data['route'], $menu_data['param'] ?? []);
    }
    return '#';
}

function slugURL($url=null)
{
    if (empty($url)) {
        $url = url()->current();
    }

    $url = explode('://', $url);
    $url = $url[count($url)-1];
    $url = explode('?', $url);
    $url = $url[0];
    $url = str_replace("\\", "/", $url);
    $url = str_replace("/", "-", $url);

    return $url;
}