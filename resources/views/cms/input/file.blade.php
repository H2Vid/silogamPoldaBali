<div class="custom-input" data-plugin="file" {{ isset($value) ? 'has-file' : '' }}  {!! arrayToHtmlProp($attr ?? []) !!}>
    <input type="hidden" name="{{ $name }}" class="metadata-listener" value="{{ $value ?? null }}">
    <input type="file" class="file-metadata-controller form-control" accept="file/*" data-path="{{ isset($path) ? encrypt($path) : null }}" data-ajax="{{ route('cms.api.upload-file') }}">
    <div class="file-preview">
        <a href="{{ isset($value) ? Storage::url($value) : '#' }}" class="btn btn-primary" target="_blank">
            <i data-feather="download"></i>
            <span class="filename">{{ isset($value) ? filename($value) : 'Document Filename' }}</span>
        </a>
        <span class="c-pointer remover text-danger">&times; Remove File</span>
    </div>
</div>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif