$(function(){
  $(window).on('popstate', function(e) {
    showLoading();
    window.location.reload();
  });

  initPlugins();

  // hide non-existing sub-menu
  if ($('li.has-child').length > 0) {
    $('li.has-child').each(function(){
      if ($(this).find('ul li').length == 0) {
        $(this).remove();
      }
    });
    $('li.has-child').each(function(){
      if ($(this).find('ul li').length == 0) {
        $(this).remove();
      }
    });
  }

  // image upload plugin
  $(document).on('click', '.image-preview img', function(){
      $(this).closest('.custom-input').find('input[type="file"]').trigger('click');
  });

  $(document).on('click', '.image-preview .remover', function(){
      ci = $(this).closest('.custom-input');
      ci.removeAttr('has-image');
      ci.find('.metadata-listener').val('');
      ci.find('.image-preview img').attr('src', ci.find('.image-preview img').attr('data-fallback'));
  });

  $(document).on('change', '.image-metadata-controller', function() {
      val = $(this).val();
      if (val == '' || typeof $(this)[0].files[0] == 'undefined') {
          // do nothing
          return
      }

      showLoading();
      currentInput = $(this);
      fd = new FormData();
      fd.append('type', 'image_upload');
      fd.append('path', $(this).attr('data-path'));
      fd.append('image', $(this)[0].files[0], $(this)[0].files[0].name);

      $.ajax({
          url : $(this).attr('data-ajax'),
          type : 'post',
          dataType : 'json',
          data : fd,
          cache: false,
          contentType : false,
          processData: false,
      }).done(resp => {
          ci = currentInput.closest('.custom-input');
          img = ci.find('.image-preview img');
          img.attr('src', resp.url);
          ml = ci.find('.metadata-listener');
          ml.val(resp.path);

          ci.attr('has-image', 1);

          hideLoading();
      }).fail(err => {
          errorHandling(err);
      });

      currentInput.val('').trigger('change');
  });


  // file upload plugin
  $(document).on('click', '.file-preview .remover', function(){
    ci = $(this).closest('.custom-input');
    ci.removeAttr('has-file');
    ci.find('.metadata-listener').val('');
  });

  $(document).on('change', '.file-metadata-controller', function() {
    val = $(this).val();
    if (val == '' || typeof $(this)[0].files[0] == 'undefined') {
        // do nothing
        return
    }

    showLoading();
    currentInput = $(this);
    fd = new FormData();
    fd.append('type', 'file_upload');
    fd.append('path', $(this).attr('data-path'));
    fd.append('file', $(this)[0].files[0], $(this)[0].files[0].name);

    $.ajax({
        url : $(this).attr('data-ajax'),
        type : 'post',
        dataType : 'json',
        data : fd,
        cache: false,
        contentType : false,
        processData: false,
    }).done(resp => {
        ci = currentInput.closest('.custom-input');
        btn = ci.find('.file-preview .btn');
        btn.find('.filename').html(resp.filename);
        btn.attr('href', resp.url);
        btn.attr('download', resp.filename);
        ml = ci.find('.metadata-listener');
        ml.val(resp.path);

        ci.attr('has-file', 1);

        hideLoading();
    }).fail(err => {
        errorHandling(err);
    });

    currentInput.val('').trigger('change');
  });

  $(document).on('keypress', '[data-timepicker]', function(e){
    key = e.which;
    if ((key >= 65 && key <=90) || (key >=97 && key <=122)) {
      e.preventDefault();
      return;
    }
  });


  $(document).on('submit', 'form.ajax-form', function(e) {
    e.preventDefault();
    method = 'POST';
    if ($(this).attr('method')) {
      method = $(this).attr('method');
    }

    showLoading();
    $.ajax({
      url : $(this).attr('action'),
      type : method,
      dataType : 'json',
      data : $(this).serialize(),
    }).done(resp => {
      // hide modal confirmation if exists first
      $('.modal').modal('hide');
      setTimeout(function(){
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
      }, 500);

      if (resp.type == 'success' && typeof resp.message != 'undefined') {
        toastr.success(resp.message);
      } else if (resp.type == 'error' && typeof resp.message != 'undefined') {
        toastr.error(resp.message);
      } else {
        toastr.info("Action completed");
      }

      redirect = null;
      
      if (typeof resp.redirect != 'undefined') {
        if (resp.redirect != null) {
          if (resp.redirect.length > 0) {
            redirect = resp.redirect;
          }
        }
      }

      if (redirect) {
        pageLoadAjax(redirect);
      } else {
        hideLoading();
      }        
    }).fail(err => {
      hideLoading();
      errorHandling(err);
    });
  });

  // delete ajax button
  $(document).on('click', '.delete-button', function(e){
    title = null;
    if ($(this).attr('data-title')) {
      title = $(this).attr('data-title');
    }

    target = null;
    if ($(this).attr('href')) {
      target = $(this).attr('href');
    }
    if ($(this).attr('data-target')) {
      target = $(this).attr('data-target');
    }

    if (target) {
      e.preventDefault();
      $('#modal-confirmation').find('.btn-proceed').attr('data-target', target);
      $('#modal-confirmation').find('strong[data-filename]').html(title);
      $('#modal-confirmation').modal('show');
    }
  });

  $(document).on('click', '.btn-trigger-delete[data-target]', function(){
    showLoading();
    $.ajax({
      url : $(this).attr('data-target'),
      type : 'POST',
      dataType : 'json',
    }).done(resp => {
      $('#modal-confirmation').modal('hide');
      if (resp.type == 'success') {
        toastr.success(resp.message);
      }
      reloadAjaxPage();
    }).fail(err => {
      errorHandling(err);
    });
  });
});

function reloadAjaxPage()
{
  currentPage = window.location.href;
  $('#main-page-content').load(currentPage, null, () => {
    hideLoading();
    if ($('#main-page-content .blank-page-title').length > 0) {
      if ($('#main-page-content .blank-page-title').val().length > 0) {
        document.title = $('#main-page-content .blank-page-title').val();
      }
    }

    initPlugins();
  });
}

function initPlugins()
{
  feather.replace()
  loadTinyMce();
  registerSlugMasterComponent();

  $('[data-role="tagsinput"]').tagsinput();

  $('.select2').each(function(){
    if (typeof $(this).attr('data-select2-id') == 'undefined') {
      $(this).select2();
    }
  });

  $('[data-timepicker]').each(function(){
    config = {
      timeFormat: 'HH:mm',
      dropdown: false,
    };
    if ($(this).attr('data-format')) {
      config.timeFormat = $(this).attr('data-format');
    }
    if ($(this).attr('data-min')) {
      config.minTime = $(this).attr('data-min');
    }
    if ($(this).attr('data-max')) {
      config.maxTime = $(this).attr('data-max');
    }
    if ($(this).attr('data-start')) {
      config.startTime = $(this).attr('data-start');
    }
    if ($(this).attr('data-dropdown')) {
      config.dropdown = true;
    }
    $(this).timepicker(config);
  });

  $('[data-datetimepicker]').each(function(){
    config = {
      showDropdowns: true,
      autoUpdateInput: true,
      singleDatePicker: true,
      locale : {
        format : 'YYYY-MM-DD'
      }
    };
    if ($(this).attr('data-start')) {
      config.startDate = new Date($(this).attr('data-start'));
    }
    if ($(this).attr('data-end')) {
      config.endDate = new Date($(this).attr('data-end'));
    }
    if ($(this).attr('data-min-date')) {
      config.minDate = new Date($(this).attr('data-min-date'));
    }
    if ($(this).attr('data-max-date')) {
      config.maxDate = new Date($(this).attr('data-max-date'));
    }
    if ($(this).attr('data-timepicker-default')) {
      config.timePicker = true;
      config.timePicker24Hour = true;
      config.locale.format = 'YYYY-MM-DD HH:mm'
    }
    if ($(this).attr('data-timepicker-second')) {
      config.timePicker = true;
      config.timePicker24Hour = true;
      config.timePickerSeconds = true;
      config.locale.format = 'YYYY-MM-DD HH:mm:ss'
    }
    if ($(this).attr('data-daterange')) {
      delete config.singleDatePicker;
    }
    if ($(this).attr('data-format')) {
      config.locale.format = $(this).attr('data-format');
    }
    if ($(this).attr('data-el')) {
      config.parentEl = $(this).attr('data-el');
    }

    currentVal = $(this).val();
    $(this).daterangepicker(config);
    if (currentVal) {
      $(this).data('daterangepicker').setStartDate(currentVal);
    }
  });

  // jquery mask global
  $('[data-money]').mask("#.##0", {reverse: true});
}

function registerSlugMasterComponent(){
// slug master if exists
if($("[slug-master]:not([saved-slug])").length){
  slug_target = $("[slug-master]").attr('data-target');
  slug_target = '[data-name="'+slug_target+'"]';
  if($(slug_target).length == 0){
    slug_target = slug_target + '-' + window.DEFAULT_LANGUAGE;
  }
  if($(slug_target).length){
    //give change event to this input
    first_load_slug = convertToSlug($(slug_target).first().val());
    $("[slug-master]").val(first_load_slug);

    $(slug_target).on('change', function(){
      slug_val = convertToSlug($(this).val());
      $("[slug-master]:not([saved-slug])").val(slug_val);
    });
  }
}

$(document).on('click', ".btn-change-slug", function(){
  $(this).addClass('btn-success');
  $(this).html('Set as Slug');
  $(this).removeClass('btn-secondary btn-change-slug');
  $(this).addClass('btn-save-slug');
  $("[slug-master]").addClass('manual').removeAttr('readonly').focus();
});

$(document).on('change', "[slug-master].manual", function(){
  $(this).attr('saved-slug', '1');
});

$(document).on('keypress', "[slug-master]", function(e){
  if(e.which == 13){
    e.preventDefault();
    $(".btn-save-slug").click();
  }
});

$(document).on('click', '.btn-save-slug', function(){
  $("[slug-master]").attr('readonly', 'readonly').removeClass('manual');
  $(this).html('Change Manually');
  $(this).removeClass('btn-success btn-save-slug').addClass('btn-change-slug btn-secondary');
});  
}

function loadTinyMce(){
tinymce.init({
  selector : 'textarea[data-richtext]',
  height : 400, 
  theme : 'modern',
  plugins : 'searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help code',
  toolbar1: 'formatselect | image media | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat code',
  image_advtab: true,
//    images_upload_url : BASE_URL + '/api/store-images',
  relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  branding : false,

  menu: {
    edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext selectall searchreplace'},
    insert: {title: 'Insert', items: 'codesample link media image table | template hr pagebreak nonbreaking insertdatetime'},
    view: {title: 'View', items: 'code visualaid fullscreen'},
    format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
  },

  images_upload_handler: function (blobInfo, success, failure) {
    var xhr, formData;

    xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', window.BASE_URL + '/api/upload-image');
    xhr.setRequestHeader('X-CSRF-TOKEN', window.CSRF_TOKEN);

    xhr.onload = function() {
      var json;
      if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
      }
      json = JSON.parse(xhr.responseText);
      if (!json || typeof json.url != 'string') {
        failure('Invalid JSON: ' + xhr.responseText);
        return;
      }
      success(json.url);
    };

    formData = new FormData();
    formData.append('image', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
  }

});
}


function errorHandling(resp){
  if(resp.responseJSON){ //kalo berbentuk xhr object, translate ke json dulu
    resp = resp.responseJSON;
  }

  if(resp.errors){
    $.each(resp.errors, function(k, v){
      toastr.error(v[0]);
    });
  }
  else if(resp.error){
    if(typeof resp.error == 'string'){
      toastr.error(resp.error);
    }
    else{
      $.each(resp.error, function(k, v){
        toastr.error(v);
      });
    }
  }
  else if(resp.type && resp.message){
    toastr.error(resp.message);
  }
  else{
    toastr.error('Sorry, we cannot process your last request');
  }
  hideLoading();
}

// will convert "proper text" to "slugged-text"
function convertToSlug(Text){
return Text
  .toLowerCase()
  .replace(/[^\w ]+/g,'')
  .replace(/ +/g,'-')
  ;
}

function numberFormat(num)
{
return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function makeid(length) 
{
let result = '';
const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
const charactersLength = characters.length;
let counter = 0;
while (counter < length) {
  result += characters.charAt(Math.floor(Math.random() * charactersLength));
  counter += 1;
}
return result;
}