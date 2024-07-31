<?php
$hash = sha1(rand(1, 99999) . uniqid());
$value = $value ?? null;

$checked = false;
if (strlen($value) > 0) {
    if ($value !== '0' && $value !== 0) {
        $checked = true;
    }
}

$yes = 'ACTIVE';
$no = 'INACTIVE';
if (isset($attr['data-yes'])) {
    $yes = $attr['data-yes'];
}
if (isset($attr['data-no'])) {
    $no = $attr['data-no'];
}
?>
<label class="switch switch-component">
  <input type="checkbox" name="{{ $name }}" id="switch-{{ $hash }}" {{ $checked ? 'checked' : '' }} value="1">
  <span class="slider" data-yes="{{ $yes }}" data-no="{{ $no }}"></span>
</label>