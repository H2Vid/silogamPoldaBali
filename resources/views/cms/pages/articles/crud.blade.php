@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <h1 class="float-left color-dark fw-500 fs-20 mb-0">Create New Article</h1>
        <div class="float-right">
            <a href="/cms/articles" class="btn btn-sm btn-secondary ajax-priority">Back</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('articles.save') }}" method="POST" enctype="multipart/form-data" class="ajax-form">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="input-group">
                        <div class="input-group-append d-none d-md-flex">
                            <span class="input-group-text">https://birosdm-poldabali.com/article/</span>
                        </div>
                        <input type="text" name="slug" class="form-control form-control-lg" id="slug" placeholder="your-slug-url" readonly>
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-secondary" id="change-slug">Change</button>
                        </div>
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success d-none" id="set-slug">Set as Slug</button>
                        </div>
                    </div>
                    <small>Note: The slug will automatically append a numeric value if it already exists.</small>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required mandatory">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="excerpt" class="form-control" rows="2" maxlength="300" placeholder="Enter short description"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="10" placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="required mandatory">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <option value="3">Category 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="required mandatory">Sub Category</label>
                        <select name="subcategory_id" class="form-control">
                            <option value="">-- Select Sub Category --</option>
                            <option value="1">Sub Category 1</option>
                            <option value="2">Sub Category 2</option>
                            <option value="3">Sub Category 3</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="form-group">
                        <label>PDF File</label>
                        <input type="file" name="pdfs[]" multiple class="form-control" accept="application/pdf">
                        <small>Please upload in PDF format.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
                        <small>Please upload in JPG/PNG format with a maximum size of 1MB.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Is Active</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Is Limited</label>
                        <select name="is_limited" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">Save Data</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let slugInput = document.getElementById("slug");
    let titleInput = document.getElementById("title");
    let changeSlugBtn = document.getElementById("change-slug");
    let setSlugBtn = document.getElementById("set-slug");

    let isSlugManual = false; // Default: slug otomatis dari title

    function generateSlug(text) {
        return text.toLowerCase().replace(/\s+/g, '').replace(/[^a-z0-9]/g, '');
    }

    // Slug otomatis ketika mengetik title (jika slug masih otomatis)
    titleInput.addEventListener("input", function() {
        if (!isSlugManual) {
            slugInput.value = generateSlug(titleInput.value);
        }
    });

    // Tombol "Change" untuk memungkinkan edit slug secara manual
    changeSlugBtn.addEventListener("click", function() {
        isSlugManual = true; // Mode manual aktif
        slugInput.removeAttribute("readonly");
        setSlugBtn.classList.remove("d-none"); // Tampilkan tombol "Set as Slug"
    });

    // Tombol "Set as Slug" untuk mengunci slug kembali
    setSlugBtn.addEventListener("click", function() {
        if (slugInput.value.trim() === "") {
            // Jika slug kosong, kembali ke mode otomatis
            isSlugManual = false;
            slugInput.value = generateSlug(titleInput.value);
        } else {
            // Kunci slug yang diinput manual
            isSlugManual = true;
        }

        slugInput.setAttribute("readonly", "readonly");
        setSlugBtn.classList.add("d-none"); // Sembunyikan tombol "Set as Slug"
    });
});
</script>

@stop