@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->
<div class="fbt-main-wrapper col-xl-12">
    <div id="main-wrapper">
        <div class="main-section" id="main_content">

            <div class="container-fluid">
                <div class="category-lister">
                    @foreach (Category::getAll() as $category)
                    <div class="category-box">
                        @if ($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->title }}">
                        @endif
                        <h4>{{ $category->title }}</h4>
                        <a href="{{ route('category', ['slug' => $category->slug]) }}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="container-fluid fbt-four-grids">
                <div class="article justify-content-center slider-width">
                    <div class="blog-posts fbt-index-post-wrap card-columns">

                        @foreach (Article::getAllBuilder(Auth::guard('cms')->check())->limit(8)->get() as $article)
                        <div class="blog-post fbt-index-post card radius-10">
                            <div class="fbt-post-thumbnail">
                                <a href="{{ route('post', ['slug' => $article->slug]) }}">
                                    <img alt="{{ $article->title }}" class="post-thumbnail lazyloaded" data-src="{{ Storage::url($article->image) }}" 
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                                </a>
                            </div>
                            <div class="fbt-post-caption card-body">
                                <h3 class="post-title h4 card-title">
                                    <a href="{{ route('post', ['slug' => $article->slug]) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-date published">{{ date('d M Y H:i', strtotime($article->created_at)) }}</span>
                                </div>
                                <p class="post-excerpt card-text">{{ descriptionMaker($article->excerpt) }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="blog-pager" id="blog-pager">
                <div class="list-inline">
                    <a class="blog-pager-older-link list-inline-item" href="{{ route('category', ['slug' => 'all']) }}" title="More posts">
                        <div class="fbt-bp-message text-uppercase font-weight-bold">More posts</div>
                        <span aria-hidden="true" class="fa fa-angle-down"></span>
                    </a>
                </div>
            </div><!-- #blog-pager -->

        </div>
    </div><!-- #main-wrapper -->

</div><!-- .fbt-main-wrapper -->
@stop