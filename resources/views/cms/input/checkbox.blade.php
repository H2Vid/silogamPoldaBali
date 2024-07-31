<?php
$arr_value = [];

if (isset($value)) {
    if (is_array($value)) {
        $arr_value = $value;
    } else if (!empty($value)) {
        $arr_value[] = $value;
    }
}

$type = $type ?? 'checkbox';

$column = 1;
if (isset($attr['column'])) {
    $column = intval($attr['column']) ?? 1;
}

if ($column == 5) {
    $column = 4;
}
if ($column > 6) {
    $column = 6;
}

$colsize = 12 / $column;
?>
<div class="{{ $type }}-container row">
    @foreach ($lists as $key => $label)
        <?php
        $hash = sha1(rand(1, 99999) . uniqid());
        ?>
        <div class="{{ $type }}-theme-default custom-{{ $type }} col-lg-{{ $colsize }}">
            <input class="{{ $type }}" type="{{ $type }}" id="check-{{ $hash }}" name="{{ $name }}" {{ in_array($key, $arr_value) ? 'checked' : '' }} value="{{ $key }}">
            <label for="check-{{ $hash }}">
                <span class="{{ $type }}-text">{{ $label }}</span>
            </label>
        </div>
    @endforeach
</div>

