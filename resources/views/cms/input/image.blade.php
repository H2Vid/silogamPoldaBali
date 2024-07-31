<?php
$value = $value ?? null;
?>
<div class="custom-input" data-plugin="image" {{ !empty($value) ? 'has-image' : '' }}  {!! arrayToHtmlProp($attr ?? []) !!}>
    <input type="hidden" name="{{ $name }}" class="metadata-listener" value="{{ $value ?? null }}">
    <input type="file" class="image-metadata-controller" accept="image/*" data-path="{{ isset($path) ? encrypt($path) : null }}" data-ajax="{{ route('cms.api.upload-image') }}">
    <div class="image-preview">
        <img src="{{ !empty($value) ? Storage::url($value) : asset('img/upload.png') }}" data-fallback="{{ asset('img/upload.png') }}">
        <span class="c-pointer remover has-transition">&times; Remove Image</span>
    </div>
</div>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif