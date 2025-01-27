@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->

<div class="flex justify-between mx-20 h-auto items-center">
    <div class=" w-full flex flex-col">
        <img class="h-[350px] w-[300px]" src="{{ asset('assets/images/LOGO SDM.png')}}" alt="LOGO SDM">
        <h3 class="mt-10 font-extrabold text-6xl text-white">BIRO</h3>
        <h3 class="font-extrabold text-6xl text-white">SDM POLDA BALI</h3>
        <p class="mt-5 font-bold text-xl text-white">JL.WR SUPRATMAN NO.7, SUMERTA KAUH, KEC.DENPASAR TIM, KOTA DENPASAR, BALI 80236</p>
    </div>
    <div class="w-full flex justify-center items-end">
        <img class="h-[80%]" src="{{ asset('assets/images/GARBHA 3D.PNG')}}" alt="maskot">
    </div>
</div>

<!--
<div class="fbt-main-wrapper col-xl-12 bg-fuchsia-500">
    <div id="main-wrapper">
        <div class="main-section" id="main_content">
            <div class="container-fluid">
                <form class="my-4 form-search" action="{{ route('category', ['slug' => 'all']) }}">
                    <input type="search" name="keyword" class="form-control form-control-lg" placeholder="Cari Pengetahuan Disini">
                    <button type="submit" class="btn btn-link text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 26 26"><path fill="currentColor" d="M10 .188A9.812 9.812 0 0 0 .187 10A9.812 9.812 0 0 0 10 19.813c2.29 0 4.393-.811 6.063-2.125l.875.875a1.845 1.845 0 0 0 .343 2.156l4.594 4.625c.713.714 1.88.714 2.594 0l.875-.875a1.84 1.84 0 0 0 0-2.594l-4.625-4.594a1.824 1.824 0 0 0-2.157-.312l-.875-.875A9.812 9.812 0 0 0 10 .188M10 2a8 8 0 1 1 0 16a8 8 0 0 1 0-16M4.937 7.469a5.446 5.446 0 0 0-.812 2.875a5.46 5.46 0 0 0 5.469 5.469a5.516 5.516 0 0 0 3.156-1a7.166 7.166 0 0 1-.75.03a7.045 7.045 0 0 1-7.063-7.062c0-.104-.005-.208 0-.312"/></svg>
                    </button>
                </form>
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

                        @foreach (Article::getAllBuilder(Auth::guard('cms')->check())->limit(8)->orderBy('id', 'DESC')->get() as $article)
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
            </div>

        </div>
    </div>
</div> -->

<!-- .fbt-main-wrapper -->
@stop