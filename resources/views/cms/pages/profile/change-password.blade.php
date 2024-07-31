@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="breadcrumb-main">
    <h4 class="text-capitalize breadcrumb-title">Change Password</h4>
</div>
<div class="card card-body">
    <form action="{{ route('cms.do-change-password') }}" class="row ajax-form" method="post">
        @csrf
        <div class="col-lg-8">
            <div class="form-group">
                <label class="required">Old Password</label>
                {!! Input::call('password', [
                    'name' => 'old_password'   
                ]) !!}
            </div>

            <div class="form-group">
                <label class="required">New Password</label>
                {!! Input::call('password', [
                    'name' => 'new_password'   
                ]) !!}
            </div>

            <div class="form-group">
                <label class="required">Repeat New Password</label>
                {!! Input::call('password', [
                    'name' => 'new_password_confirmation'   
                ]) !!}
            </div>
        </div>
        <div class="col-lg-4">

        </div>

        <div class="col">
            <button class="btn btn-primary"><i data-feather="key"></i> Change Password</button>
        </div>
    </form>
</div>
@stop