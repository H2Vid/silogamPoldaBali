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

        <div class="form-group">
            <label class="required">Title</label>
            <input type="text" name="title" class="form-control" required value="{{ isset($subcategory) ? $subcategory->title : '' }}">
        </div>

        <!-- Pilih Kategori -->
        <div class="form-group">
             <label class="required">Pilih Kategori</label>
            <select name="category_id" class="form-control" required>
             <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ isset($subcategory) && $subcategory->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->title }}  <!-- Tampilkan title kategori -->
            </option>
                 @endforeach
             </select>
        </div>


        <div class="form-group">
            <label>Description</label>
            <textarea class="tinymce-editorSUbcategory form-control" rows="10" name="description">{{ isset($subcategory) ? $subcategory->description : '' }}</textarea>
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
    <label for="switch-180e9770cbf6fd61e219cba26204d276b48b6e1e">Is Active</label>
    <label class="switch switch-component">
        <input type="checkbox" name="is_active" id="switch-180e9770cbf6fd61e219cba26204d276b48b6e1e" value="1"
            {{ isset($subcategory) && $subcategory->is_active ? 'checked' : '' }}>
        <span class="slider" data-yes="ACTIVE" data-no="INACTIVE"></span>
    </label>
</div>

        <button class="btn btn-primary" type="submit">{{ isset($subcategory) ? 'Update' : 'Save' }} Data</button>
    </form>
</div>
<script>
 //tinymce
    document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: ".tinymce-editorSUbcategory",
        plugins: "advlist autolink lists link image charmap preview anchor",
        toolbar: "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        height: 300
    });
});

</script>
@stop
