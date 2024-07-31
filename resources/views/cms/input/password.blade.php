<div class="position-relative">
    <input type="password" name="{{ $name }}" class="form-control" value="{{ $value ?? null }}" {!! arrayToHtmlProp($attr ?? []) !!}>
    <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
</div>
@if (isset($attr['notes']))
<span class="text-mute"><small>{{ $attr['notes'] }}</small></span>
@endif