@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.auth')

@section ('content')
<div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="edit-profile mt-md-25 mt-0">
                <div class="card border-0">
                    <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10 ">
                        <div class="edit-profile__title">
                            <h6>Reset Password <span class="color-primary">your account</span></h6>
                        </div>
                    </div>
                    <form action="{{ route('cms.auth.do-reset-password', ['token' => $token]) }}" class="card-body" method="POST">
                        @csrf

                        <div class="alert alert-info"><div><strong>One last step!</strong><br>Please insert your new password below. Make sure to keep your password long and secure.</div></div>

                        <div class="edit-profile__body">
                            <div class="form-group mb-15">
                                <label for="email-field">Your Email</label>
                                <div class="position-relative">
                                    <input id="email-field" type="text" readonly class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group mb-15">
                                <label for="password-field">New Password</label>
                                <div class="position-relative">
                                    <input id="password-field" type="password" name="password" maxlength="100" class="form-control" name="password" value="">
                                    <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
                                </div>
                            </div>
                            <div class="form-group mb-15">
                                <label for="password-field">Repeat New Password</label>
                                <div class="position-relative">
                                    <input id="password-field" type="password" name="password_confirmation" maxlength="100" class="form-control" name="password" value="">
                                    <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2 pass-toggler" style="cursor:pointer;"></div>
                                </div>
                            </div>
                            <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                <button type="submit" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                    Reset Password Now
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
@endpush