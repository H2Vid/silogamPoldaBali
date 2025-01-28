<?php
// // Sementara didisable agar sharer bisa digunakan oleh model yg tidak memiliki trait Translateable
// $txt = urlencode($data->outputTranslate('title'));
$txt = urlencode($data->title);
$wa_txt = str_replace('+', '%20', $txt);
?>
<div style="display:inline-block;" class="{{ isset($not_white) ? '' : 'color-white' }}">
    <span class="font-weight-bold mr-2 d-none d-sm-inline-block text-white">Share</span>

    <a target="_blank" class="sharer-item {{ isset($not_white) ? '' : 'color-white' }} d-inline-block mx-1" href="https://www.facebook.com/sharer.php?u={{ url()->current() }}"><i title="Facebook" class="iconify" data-icon="logos:facebook"></i></a>
    <a target="_blank" class="sharer-item {{ isset($not_white) ? '' : 'color-white' }} d-inline-block mx-1" href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $txt }}&via={{ config('cms.twitter_username', 'JECEyeHospital') }}&hashtags={{ config('cms.twitter_username', 'JECEyeHospital') }}"><i title="Twitter" class="iconify" data-icon="logos:twitter"></i></a>
    <a target="_blank" data-action="share/whatsapp/share" class="sharer-item {{ isset($not_white) ? '' : 'color-white' }} d-inline-block mx-1" href="https://api.whatsapp.com/send?text={{ $wa_txt }} - {{ url()->current() }}"><i title="Whatsapp" class="iconify" data-icon="logos:whatsapp"></i></a>
    @if (isset($additional))
        @foreach ($additional as $row)
        <a target="_blank" class="sharer-item {{ isset($row['class']) ? $row['class'] : '' }} {{ isset($not_white) ? '' : 'color-white' }} d-inline-block mx-1" href="{{ $row['href'] ?? '#' }}">
            <i title="{{ $row['title'] ?? null }}" class="bi bi-{{ $row['icon'] ?? null }}"></i>
        </a>
        @endforeach
    @endif
</div>