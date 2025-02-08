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
        <form action="{{ route('articles.save') }}" method="POST" enctype="multipart/form-data" >
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
                            <select name="category_id" class="form-control" id="category-select">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                    <label class="">Sub Category</label>
                        <select name="subcategory_id" class="form-control" id="subcategory-select">
                            <option value="">-- Select Sub Category --</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}">
                                    {{ $subcategory->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="form-group">
                  <!-- Upload PDF (Default: hanya 1, disimpan ke `pdf`) -->
                    <label for="pdf">Upload PDF:</label>
                    <input type="file" name="pdf" accept="application/pdf" id="single-pdf"><br>

                    <!-- Container untuk tambahan PDF (disimpan ke `pdfs`) -->
                    <div id="pdf-container"></div>

                    <button type="button" id="add-pdf-btn">Tambah PDF</button><br>

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
    // slug
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

// akhir slug

// memilih subkategori berdasarkan id yang diselect di kategori
document.addEventListener("DOMContentLoaded", function() {
    const categorySelect = document.getElementById('category-select');
    const subcategorySelect = document.getElementById('subcategory-select');

    // Dapatkan semua subkategori dari data yang sudah ada di halaman
    const subcategories = @json($subcategories); // Mengirim semua subkategori dari server ke JavaScript

    // Listen for category selection change
    categorySelect.addEventListener('change', function() {
        const categoryId = categorySelect.value;

        // Kosongkan subkategori sebelumnya
        subcategorySelect.innerHTML = '<option value="">-- Select Sub Category --</option>';

        // Jika ada kategori yang dipilih
        if (categoryId) {
            // Filter subkategori berdasarkan category_id
            const filteredSubcategories = subcategories.filter(subcategory => subcategory.category_id == categoryId);

            // Tampilkan subkategori yang sesuai dengan kategori
            filteredSubcategories.forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.title;

                subcategorySelect.appendChild(option); // Tambahkan subkategori ke dropdown
            });
        }
    });
});
// akhir subkategori

//add pdf file
document.getElementById('add-pdf-btn').addEventListener('click', function() {
        const singlePDF = document.getElementById('single-pdf');
        const container = document.getElementById('pdf-container');

        // Jika user pertama kali menekan "Tambah PDF"
        if (singlePDF.name === 'pdf') {
            singlePDF.name = 'pdfs[]'; // Ubah menjadi array
            container.appendChild(singlePDF); // Pindahkan ke pdf-container
        }

        // Tambahkan input baru untuk PDF tambahan
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'pdfs[]';
        newInput.accept = 'application/pdf';
        container.appendChild(document.createElement('br'));
        container.appendChild(newInput);
    });

</script>

@stop