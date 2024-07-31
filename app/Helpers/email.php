<?php
//reformat khusus utk google email
function reformatEmail($email)
{
    $exp = explode('@', $email);
    if (count($exp) != 2) {
        return false;
    }

    $name = $exp[0];
    $host = $exp[1];

    if (in_array($host, ['gmail.com'])) {
        $name = str_replace(".", "", $name);

        $n = strpos($name, "+");
        if ($n) {
            $name = substr($name, 0, $n);
        }
    }
    $email = $name . "@" . $host;
    return $email;
}