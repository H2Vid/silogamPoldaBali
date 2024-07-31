@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.auth')

@section ('content')
<div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
    <div class="signUp-topbar d-flex align-items-center justify-content-md-end justify-content-center mt-md-0 mb-md-0 mt-20 mb-1">
        @if (config('cms.feature.auth.enable_registration'))
        <p class="mb-0">
            Don't have an account?
            <a href="{{ route('cms.auth.register') }}" class="color-primary ajax-priority">
                Register Now!
            </a>
        </p>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="edit-profile mt-md-25 mt-0">
                <div class="card border-0">
                    <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10">
                        <div class="edit-profile__title">
                            <img style="height:50px;" src="{{ Setting::getUrl('general.logo', asset(config('cms.site_square_logo'))) }}" alt="{{ Setting::get('general.title', config('cms.site_title')) }}">
                            <h6 class="mt-3">Login to <span class="color-primary">your account</span></h6>
                        </div>
                    </div>
                    <form action="{{ route('cms.auth.do-login') }}" class="card-body" method="POST">
                        @csrf
                        <div class="edit-profile__body">
                            <div class="form-group mb-20">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="your@email.com" maxlength="100">
                            </div>
                            <div class="form-group mb-15">
                                <label for="password-field">Password</label>
                                <div class="position-relative">
                                    <input id="password-field" type="password" name="password" maxlength="100" class="form-control" name="password" value="">
                                    <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
                                </div>
                            </div>
                            <div class="signUp-condition signIn-condition">
                                @if (config('cms.feature.auth.enable_remember_me'))
                                <div class="checkbox-theme-default custom-checkbox ">
                                    <input class="checkbox" value="1" name="remember" type="checkbox" id="check-1">
                                    <label for="check-1">
                                        <span class="checkbox-text">Keep me logged in</span>
                                    </label>
                                </div>
                                @endif
                                @if (config('cms.feature.auth.enable_reset_password'))
                                <a href="#forgot-password-modal" data-toggle="modal">forgot password?</a>
                                @endif
                            </div>
                            <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                <button type="submit" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                    Sign In
                                </button>
                            </div>

                        </div>
                    </form><!-- End: .card-body -->
                </div><!-- End: .card -->
            </div><!-- End: .edit-profile -->
        </div><!-- End: .col-xl-5 -->
    </div>
</div><!-- End: .signUp-admin-right  -->
@stop

@push ('modal')
@if (config('cms.feature.auth.enable_reset_password'))
<div class="modal fade" id="forgot-password-modal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('cms.auth.do-forgot-password') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>We will send reset password link to your email. Please type your email below</p>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com" maxlength="100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>       
@endif
@endpush