<textarea name="{{ $name }}" {!! isset($data) ? $data.'="1"' : '' !!}  class="form-control" {!! arrayToHtmlProp($attr ?? []) !!}>{{ $value ?? null }}</textarea>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif