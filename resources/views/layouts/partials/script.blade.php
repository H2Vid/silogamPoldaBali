@stack ('modal')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
$(function() {
    $('.login-form').on('submit', function(e) {
        e.preventDefault();
        showLoading();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',            
        }).done(resp => {
            window.location.reload();
        }).fail(err => {
            hideLoading();
            errorHandling(err);
        });
    });
});
</script>
@stack ('script')