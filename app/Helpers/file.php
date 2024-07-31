<?php
function fileUploadMaxFilesize($mb = 0)
{
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $post_max_size = parseSize(ini_get('post_max_size'));
        if ($post_max_size > 0) {
            $max_size = $post_max_size;
        }

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = parseSize(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }

    $setting_max_size = config('cms.max_filesize.file') * 1024 * 1024;
    $max_size = min($max_size, $setting_max_size);

    if ($mb > 0) {
        return min($max_size, ($mb * 1024 * 1024));
    }
    return $max_size;
}    

function parseSize($size)
{
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    } else {
        return round($size);
    }
}    

function filesizeFormatted($path)
{
    $size = filesize($path);
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}

function filename($storage_path_or_url) {
    $storage_path_or_url = str_replace('\\', '/', $storage_path_or_url);
    $split = explode('/', $storage_path_or_url);
    
    return $split[count($split)-1];
}