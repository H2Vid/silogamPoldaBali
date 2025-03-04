@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">Subcategory Management</p>
        <div class="float-right">
            <a href="{{ route('cms.subcategory.crud') }}" class="btn btn-sm btn-primary">+ Add Data</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card-body bg-white mt-3 rounded mb-10">
    <!-- Form Pencarian dan Dropdown Per Page -->
    <form action="{{ route('cms.subcategory.index') }}" method="GET" class="mb-3">
        <div class="d-flex justify-content-between">
        <div class="col-md-2">
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
            <div class="col-md-4 d-flex">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title or description">

                <button type="submit" class="btn btn-primary">Search</button>
            </div>

        </div>
    </form>

    <!-- Tabel Data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th class="col-2">Title</th>
                <th class="col-3">Description</th>
                <th class="col-2">Image</th>
                <th class="col-1">Status</th>
                <th class="col-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $index => $subcategory)
            <tr>
                <td>{{ $subcategories->firstItem() + $index }}</td> <!-- Update penomoran -->
                <td>{{ $subcategory->title }}</td>
                <td>{!! $subcategory->description !!}</td>
                <td>
                    @if ($subcategory->image)
                    <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->title }}" width="100" height="50">
                    @else
                    <p>No image</p>
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ $subcategory->is_active ? 'success' : 'danger' }}">
                        {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="d-flex">
                    <a href="{{ route('cms.subcategory.edit', $subcategory->id) }}" class="btn mr-2 btn-sm btn-warning">Edit</a>
                    <form action="{{ route('cms.subcategory.delete', $subcategory->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan Informasi Pagination -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span>Showing {{ $subcategories->firstItem() }} to {{ $subcategories->lastItem() }} of {{ $subcategories->total() }} entries</span>
        </div>

        <!-- Pagination -->
        <div>
            {{ $subcategories->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@stop
