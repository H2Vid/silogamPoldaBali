@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="card mt-5">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">{{ isset($subcategory) ? 'Edit' : 'Create New' }} Sub Category</p>
        <div class="float-right">
            <a href="/cms/subcategory" class="btn btn-sm btn-secondary ajax-priority">Back</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="card-body bg-white mt-3 rounded mb-10">
    <!-- Form action tergantung pada apakah sedang edit atau create -->
    <form action="{{ isset($subcategory) ? route('cms.subcategory.update', $subcategory->id) : route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($subcategory))
            @method('PUT')
        @endif

        <div class="mb-3">
            <div class="input-group">
                <div class="input-group-append d-none d-md-flex">
                    <span class="input-group-text">https://birosdm-poldabali.com/subcategory</span>
                </div>
                <input type="text" name="slug_master" class="form-control form-control-lg" readonly value="{{ isset($subcategory) ? $subcategory->slug_master : '' }}" placeholder="your-slug-url">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-secondary">Change</button>
                </div>
            </div>
            <small>Note: Slug akan otomatis ditambahkan angka jika sudah ada.</small>
        </div>

        <div class="form-group">
            <label class="required">Title</label>
            <input type="text" name="title" class="form-control" required value="{{ isset($subcategory) ? $subcategory->title : '' }}">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" rows="10" name="description">{{ isset($subcategory) ? $subcategory->description : '' }}</textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if (isset($subcategory) && $subcategory->image)
                <p>Current Image: <img src="{{ asset('storage/' . $subcategory->image) }}" width="100" alt="Current Image"></p>
            @endif
            <small>Upload JPG/PNG maksimal 1MB</small>
        </div>

        <div class="form-group">
            <label>Is Active</label>
            <input type="checkbox" name="is_active" value="1" {{ isset($subcategory) && $subcategory->is_active ? 'checked' : '' }}>
        </div>

        <button class="btn btn-primary" type="submit">{{ isset($subcategory) ? 'Update' : 'Save' }} Data</button>
    </form>
</div>
@stop
