@extends ('layouts.master')

@section ('content')
<div class="blog-posts fbt-item-post-wrap" style="max-width:90%">
    <div class="blog-post fbt-item-post">

        <div class="slider-container">
            <div class="row align-items-center slider-width">
                <div class="col-lg-7">
                    <div class="fbt-shape-container">
                        <div class="fbt-item-thumbnail radius-10">
                            <img alt="{{ $article->title }}" class="post-thumbnail lazyloaded" 
                                data-src="{{ Storage::url($article->image) }}"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="fbt-shape-title pl-xl-5 pl-lg-4">
                        <h1 class="post-title display-4">
                            {{ $article->title }}
                        </h1>
                        <div class="item-post-meta mt-4">
                            <div class="post-meta">
                                @if (isset($article->category->title))
                                <span class="post-author"><a href="{{ route('category', ['slug' => $article->category->slug]) }}" target="_blank" title="fbtemplates">{{ $article->category->title }}</a></span>
                                @endif
                                <span class="post-date published">{{ date('d M Y', strtotime($article->created_at)) }}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!-- .slider-container end-->

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="mt-n5">
                    <div class="post-body post-content">
                        {!! $article->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
