@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section('content')
<div class="card mt-5">
    <div class="card-body">
        <p class="float-left color-dark fw-500 fs-20 mb-0">Subcategories</p>
        <div class="float-right">
            <a href="{{ route('cms.subcategory.crud') }}" class="btn btn-sm btn-primary">+ Add Data</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="card-body bg-white mt-3 rounded mb-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subcategory->title }}</td>
                <td>{{ $subcategory->description }}</td>
                <td>
                    @if ($subcategory->image)
                    <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->title }}" width="100">
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    @if ($subcategory->is_active)
                    <span class="badge badge-success">Active</span>
                    @else
                    <span class="badge badge-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
