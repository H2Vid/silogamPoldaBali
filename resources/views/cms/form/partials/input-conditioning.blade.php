@if ($is_translateable && $row->getTranslateable())
    <?php
    $available_lang = config('cms.lang.available', ['en' => 'English']);
    $default_lang = config('cms.lang.default', 'en');
    $name = $row->getField();
    ?>

    <table class="table table-hover" style="width:100%;">
        @foreach ($available_lang as $langcode => $langname)
        <tr>
            <td valign="top" style="width:100px;">
                <div class="d-block badge badge-{{ $langcode == $default_lang ? 'dark' : 'white' }}" style="padding: 4px 6.64px">{{ $langname }} 
                    @if ($langcode == $default_lang)
                    <i style="color:#d00; margin:0 .5em;">*</i>
                    @endif
                </div>
            </td>
            <td valign="top">
                @include ('cms.form.partials.input-single', [
                    'name' => $name . '['.$langcode.']',
                    'shown_value' => $shown_value[$langcode] ?? null,
                ])
            </td>
        </tr>
        @endforeach
    </table>

@else
    @include ('cms.form.partials.input-single')
@endif