@extends (request()->ajax() ? 'cms.layouts.blank' : 'cms.layouts.master')

@section ('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <p class="color-dark fw-500 fs-20 mb-0">Dashboard</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-0">Artikel Terbaru</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($latest_post as $post)
                        <li class="list-group-item"><a href="{{ route('post', ['slug' => $post->slug]) }}" target="_blank">{{ $post->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="my-0">List Kategori</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($categories as $cat)
                        <li class="list-group-item">{{ $cat->title }}</li>
                        @endforeach
                    </ul>                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="my-0">List Admin</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($admin as $ad)
                        <li class="list-group-item">{{ $ad->name }}</li>
                        @endforeach
                    </ul>  
                </div>
            </div>            
        </div>
    </div>
</div>
@stop