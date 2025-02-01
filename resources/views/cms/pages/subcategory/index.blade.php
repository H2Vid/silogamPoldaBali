@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="card mb-3">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">{{ $title ?? 'Subcategory' }}</p>
        <div class="float-right">
            <a href="/cms/subcategory/create" class="btn btn-sm btn-primary ajax-priority">+ Add Subcategory</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <table class="table table-bordered" id="subcategoryTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subcategory Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data subcategory akan ditampilkan di sini -->
            </tbody>
        </table>
    </div>
</div>
@stop

@push ('script')
<script>
    let subcategories = [];

    function renderTable() {
        let tbody = document.querySelector("#subcategoryTable tbody");
        tbody.innerHTML = "";

        subcategories.forEach((subcategory, index) => {
            let row = `<tr>
                <td>${index + 1}</td>
                <td>${subcategory}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="deleteSubcategory(${index})">Delete</button>
                </td>
            </tr>`;
            tbody.innerHTML += row;
        });
    }

    function addSubcategory() {
        let subcategoryName = prompt("Enter subcategory name:");
        if (subcategoryName) {
            subcategories.push(subcategoryName);
            renderTable();
        }
    }

    function deleteSubcategory(index) {
        if (confirm("Are you sure you want to delete this subcategory?")) {
            subcategories.splice(index, 1);
            renderTable();
        }
    }
</script>
@endpush