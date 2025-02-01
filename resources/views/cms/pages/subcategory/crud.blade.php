@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="card ">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">Create New Sub Category</p>
        <div class="float-right">
            <a href="/cms/subcategory" class="btn btn-sm btn-secondary   ajax-priority">Back</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="card-body bg-white mt-10 rounded mb-10">
    <form action="http://silogam.birologistik-poldabali.id.test/cms/category/create" method="POST" class="ajax-form">
        <input type="hidden" name="_token" value="W2QshMgBa7v4heqtfPRqYtJWq9u4hq2Y09FdFVlG">
        <div class="mb-3">
            <div class="input-group">
                <div class="input-group-append d-none d-md-flex">
                    <span class="input-group-text" id="basic-addon1">https://birosdm-poldabali.com//category</span>
                </div>
                <input type="text" name="slug_master" class="form-control form-control-lg" readonly="" slug-master="" value="" placeholder="your-slug-url" data-target="title">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-secondary btn-change-slug">Change</button>
                </div>
            </div>
            <small>Note : slug will automatically appended with numeric value if data is already exists.</small>
        </div>

        <div class="tab-content autocrud-content" id="autocrud-tab-content">
            <div class="tab-pane card-body fade show active" id="form-tab-default" role="tabpanel">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group custom-form-group " data-crud="title">
                            <label class="required mandatory">Title</label>
                            <div>
                                <input type="text" name="title" class="form-control" value="" data-name="title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group custom-form-group " data-crud="description">
                            <label class="">Description</label>
                            <div>
                                <div id="mceu_19" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 100%;">
                                    <div id="mceu_19-body" class="mce-container-body mce-stack-layout">
                                        <div id="mceu_20" class="mce-top-part mce-container mce-stack-layout-item mce-first">
                                            <div id="mceu_20-body" class="mce-container-body">
                                                <div id="mceu_21" class="mce-container mce-menubar mce-toolbar mce-first" role="menubar" style="border-width: 0px 0px 1px;">
                                                    <div id="mceu_21-body" class="mce-container-body mce-flow-layout">
                                                        <div id="mceu_22" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-first mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_22" role="menuitem" aria-haspopup="true">
                                                            <button id="mceu_22-open" role="presentation" type="button" tabindex="-1">
                                                                <span class="mce-txt">Edit</span> <i class="mce-caret"></i>
                                                            </button>
                                                        </div>
                                                        <div id="mceu_23" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_23" role="menuitem" aria-haspopup="true">
                                                            <button id="mceu_23-open" role="presentation" type="button" tabindex="-1">
                                                                <span class="mce-txt">Insert</span> <i class="mce-caret"></i>
                                                            </button>
                                                        </div>
                                                        <div id="mceu_24" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_24" role="menuitem" aria-haspopup="true">
                                                            <button id="mceu_24-open" role="presentation" type="button" tabindex="-1">
                                                                <span class="mce-txt">View</span> <i class="mce-caret"></i>
                                                            </button>
                                                        </div>
                                                        <div id="mceu_25" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_25" role="menuitem" aria-haspopup="true">
                                                            <button id="mceu_25-open" role="presentation" type="button" tabindex="-1">
                                                                <span class="mce-txt">Format</span> <i class="mce-caret"></i>
                                                            </button>
                                                        </div>
                                                        <div id="mceu_26" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-last mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_26" role="menuitem" aria-haspopup="true">
                                                            <button id="mceu_26-open" role="presentation" type="button" tabindex="-1">
                                                                <span class="mce-txt">Table</span> <i class="mce-caret"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="description" data-richtext="1" class="form-control" data-name="description" id="description" aria-hidden="true" style="display: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-form-group " data-crud="image">
                            <label class="">Image</label>
                            <div>
                                <div class="custom-input" data-plugin="image" data-name="image">
                                    <input type="hidden" name="image" class="metadata-listener" value="">
                                    <input type="file" class="image-metadata-controller" accept="image/*" data-path="" data-ajax="http://silogam.birologistik-poldabali.id.test/cms/api/upload-image">
                                    <div class="image-preview">
                                        <img src="http://silogam.birologistik-poldabali.id.test/img/upload.png" data-fallback="http://silogam.birologistik-poldabali.id.test/img/upload.png">
                                        <span class="c-pointer remover has-transition">× Remove Image</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <small>Please upload with JPG/PNG format maximum 1MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-form-group " data-crud="is_active">
                            <label class="">Is Active</label>
                            <div>
                                <label class="switch switch-component">
                                    <input type="checkbox" name="is_active" id="switch-bc04323e1c4e49dfad04007c28fbfae4e697fd94" value="1">
                                    <span class="slider" data-yes="ACTIVE" data-no="INACTIVE"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Save Data</button>
    </form>
</div>

@stop
