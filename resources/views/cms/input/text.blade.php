<input type="{{ $type ?? 'text' }}" name="{{ $name }}" {!! isset($data) ? $data.'="1"' : '' !!} class="form-control" value="{{ $value ?? null }}" {!! arrayToHtmlProp($attr ?? []) !!}>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif