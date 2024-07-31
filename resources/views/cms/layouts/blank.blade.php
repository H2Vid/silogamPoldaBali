@stack ('style')
<input type="hidden" class="blank-page-title" value="{{ titleGenerate($title ?? null) }}">
@yield ('content')
@stack ('modal')
@stack ('script')