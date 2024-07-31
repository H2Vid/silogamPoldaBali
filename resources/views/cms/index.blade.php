@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <p class="color-dark fw-500 fs-20 mb-0">Dashboard</p>
        </div>
    </div>
</div>
@stop