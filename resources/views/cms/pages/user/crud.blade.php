@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="card mb-3">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">{{ $title ?? null }}</p>
        <div class="float-right">
            <a href="{{ route('cms.user.index') }}" class="btn btn-sm btn-secondary ajax-priority">Back</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ $route }}" method="POST" class="ajax-form">
            @csrf
            {!! $form->renderForm() !!}

            <button class="btn btn-primary">Save Data</button>
        </form>
    </div>
</div>
@stop
