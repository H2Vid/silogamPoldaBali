@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="card mb-3">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">{{ $title ?? '-' }}</p>
        <div class="float-right">
            @if (isset($create_route))
                @if (Permission::has($create_route))
                <a href="{{ route($create_route) }}" class="btn btn-sm btn-primary ajax-priority">+ Add Data</a>
                @endif
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        {!! $datatable->renderTable() !!}
    </div>
</div>
@stop

@push ('script')
    {!! $datatable->renderScript() !!}
@endpush