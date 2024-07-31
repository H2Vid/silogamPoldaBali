@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="breadcrumb-main">
    <h4 class="text-capitalize breadcrumb-title">Manage Profile</h4>
</div>
<div class="card card-body">
    <form action="{{ route('cms.do-profile') }}" class="row ajax-form" method="post">
        @csrf
        <div class="col-lg-8">
            <div class="form-group">
                <label class="required">Full Name</label>
                {!! Input::call('text', [
                    'name' => 'name',
                    'value' => $user->name,    
                ]) !!}
            </div>

            <div class="form-group">
                <label class="required">Email</label>
                {!! Input::call('email', [
                    'name' => 'email',
                    'value' => $user->email,    
                ]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Profile Image</label>
                {!! Input::call('image', [
                    'name' => 'image',
                    'value' => $user->image ?? null,
                ]) !!}
            </div>
        </div>

        <div class="col">
            <button class="btn btn-primary"><i data-feather="save"></i> Save Profile</button>
        </div>
    </form>
</div>
@stop