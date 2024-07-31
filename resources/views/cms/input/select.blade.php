<?php
$arr_value = [];

if (isset($value)) {
    if (is_array($value)) {
        $arr_value = $value;
    } else if (!empty($value)) {
        $arr_value[] = $value;
    }
}

$has_selected = false;
foreach ($lists as $key => $label) {
    if (in_array($key, $arr_value)) {
        $has_selected = true;
    }
}
?>
<select name="{{ $name }}" class="form-control select2" {{ isset($is_multiple) ? 'multiple' : '' }} {!! arrayToHtmlProp($attr ?? []) !!} @if(isset($attr['placeholder'])) data-placeholder="{{ $attr['placeholder'] }}" @endif>
    @if ($is_multiple != true)
    <option value="" disabled {{ $has_selected ? '' : 'selected' }}>{{ isset($attr['placeholder']) ? $attr['placeholder'] : '' }}</option>
    @endif
    @foreach ($lists as $key => $label)
    <option value="{{ $key }}" {{ in_array($key, $arr_value) ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif