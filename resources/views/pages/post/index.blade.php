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
                        <h1 class="post-title display-4 text-white">
                            {{ $article->title }}
                        </h1>
                        <div class="item-post-meta mt-4">
                            <div class="post-meta text-white">
                                @if (isset($article->category->title))
                                <span class="post-author text-white"><a class="text-white" href="{{ route('category', ['slug' => $article->category->slug]) }}" target="_blank" title="fbtemplates">{{ $article->category->title }}</a></span>
                                @endif
                                <span class="post-date published text-white">{{ date('d M Y', strtotime($article->created_at)) }}</span>
                            </div>
                            <div class="post-meta mb-4">
                                <span>
                                    <i class="iconify" data-icon="emojione-v1:eye"></i>
                                    <span class="text-white">{{ number_format($article->viewer) }}</span>
                                </span>
                            </div>

                            @include ('components.sharer', ['data' => $article])
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- .slider-container end-->

        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="text-white">
                    <div class="post-body post-content text-white">
                        <span class="text-white">
                            {!! $article->description !!}
                        </span>
                        <?php
                        $pdfs = [];
                        if ($article->pdfs) {
                            $pdfs = json_decode($article->pdfs, true) ?? [];
                        }
                        ?>
                        @if (count($pdfs) > 0)
                        <div class="my-4">
                            @foreach ($pdfs as $pdf)
                            <a href="{{ Storage::url($pdf) }}" class="btn btn-sm w-100 btn-light border shadow" target="_blank">
                                <span class="iconify" data-icon="line-md:download-loop"></span>
                                <span class="filename">{{ filename($pdf) }}</span>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 text-white">
                <h3 class="text-white">Artikel Lainnya</h3>
                <div class="my-4 text-white">
                    @foreach ($other_articles as $other_article)
                    <div class="d-flex align-items-center mb-3">
                        <div class="fbt-item-thumbnail radius-10">
                            <a href="{{ route('post', ['slug' => $other_article->slug]) }}">
                                <img alt="{{ $other_article->title }}" class="post-thumbnail lazyloaded"
                                data-src="{{ Storage::url($other_article->image) }}" style="width: 50px; height: 50px;"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                            </a>
                        </div>
                        <div class="ml-3">
                            <a href="{{ route('post', ['slug' => $other_article->slug]) }}" class="text-dark">
                                <h6 class="mb-0 text-white">{{ $other_article->title }}</h6>
                            </a>
                            <div>
                                <small class="text-white"><a href="{{ route('category', ['slug' => $other_article->category->slug]) }}" target="_blank" title="fbtemplates">{{ $other_article->category->title }}</a></small>
                            </div>
                            <div>
                                <small class="text-white">{{ date('d M Y', strtotime($other_article->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push ('script')
<script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>
@endpush