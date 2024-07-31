@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.auth')

@section ('content')
<div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
<div class="signUp-topbar d-flex align-items-center justify-content-md-end justify-content-center mt-md-0 mb-md-0 mt-20 mb-1">
    <p class="mb-0">
        Already have an account?
        <a href="{{ route('cms.auth.login') }}" class="color-primary ajax-priority">
            Sign In Now!
        </a>
    </p>
</div><!-- End: .signUp-topbar  -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="edit-profile mt-md-25 mt-0">
            <div class="card border-0">
                <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10 ">
                    <div class="edit-profile__title">
                        <img style="height:50px;" src="{{ Setting::getUrl('general.logo', asset(config('cms.site_square_logo'))) }}" alt="{{ Setting::get('general.title', config('cms.site_title')) }}">
                        <h6 class="mt-3">Start Create <span class="color-primary">your account</span></h6>
                    </div>
                </div>
                <form action="{{ route('cms.auth.do-register') }}" method="POST" class="card-body">
                    @csrf
                    <div class="edit-profile__body">
                        <div class="form-group mb-20">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="your@email.com" maxlength="100" value="{{ old('email') }}">
                            </div>
                            <div class="form-group mb-20">
                                <label for="full_name" class="required">Full Name</label>
                                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Your Name" maxlength="100" value="{{ old('full_name') }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-15">
                                        <label class="required" for="password-field">Password</label>
                                        <div class="position-relative">
                                            <input id="password-field" type="password" maxlength="100" class="form-control" name="password" value="">
                                            <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-15">
                                        <label class="required" for="password-field">Repeat Password</label>
                                        <div class="position-relative">
                                            <input id="password-field" type="password" maxlength="100" class="form-control" name="password_confirmation" value="">
                                            <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                <button type="submit" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                    Create Account
                                </button>
                            </div>

                        </div>
                    </div>
                </form><!-- End: .card-body -->
            </div><!-- End: .card -->
        </div><!-- End: .edit-profile -->
    </div><!-- End: .col-xl-5 -->
</div>
</div><!-- End: .signUp-admin-right  -->
@stop