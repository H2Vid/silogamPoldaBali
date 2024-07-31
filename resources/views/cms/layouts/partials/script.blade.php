<script>
var BASE_URL = '{{ adminURL('/') }}';
var CSRF_TOKEN = '{{ csrf_token() }}';
var DEFAULT_LANGUAGE = '{{ config('cms.lang.default') }}';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});    
</script>
<script src="{{ asset('cms_assets/vendor_assets/js/bootstrap/popper.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/moment/moment.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/daterangepicker.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/drawer.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/feather.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/footable.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/fullcalendar@5.2.0.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/loader.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/message.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/moment.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/notification.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/popover.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/select2.full.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/wickedpicker.min.js') }}"></script>
<script src="{{ asset('cms_assets/vendor_assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('cms_assets/theme_assets/js/drag-drop.js') }}"></script>
<script src="{{ asset('cms_assets/theme_assets/js/footable.js') }}"></script>
<script src="{{ asset('cms_assets/theme_assets/js/full-calendar.js') }}"></script>
<script src="{{ asset('cms_assets/theme_assets/js/icon-loader.js') }}"></script>


<script type="text/javascript" src="{{ asset('cms_assets/vendor_assets/datatable/DataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms_assets/vendor_assets/datatable/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms_assets/vendor_assets/datatable/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms_assets/vendor_assets/datatable/FixedColumns/js/dataTables.fixedColumns.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('cms_assets/vendor_assets/datatable/ColReorder/js/dataTables.colReorder.min.js') }}"></script>

<script src="{{ asset('cms_assets/theme_assets/js/main.js') }}"></script>
<script src="{{ asset('cms_assets/theme_assets/js/custom.js?v=' . time()) }}"></script>
@include ('cms.layouts.partials.error-handle-script')
@stack ('script')