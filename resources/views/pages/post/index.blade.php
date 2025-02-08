@extends ('layouts.master')

@section ('content')
<div class="blog-posts fbt-item-post-wrap w-[90%] mx-auto">
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
                                <span class="post-author text-white">
                                    <a class="text-white" href="{{ route('category', ['slug' => $article->category->slug]) }}" target="_blank">
                                        {{ $article->category->title }}
                                    </a>
                                </span>
                                @endif
                                <span class="post-date published text-white">
                                    {{ date('d M Y', strtotime($article->created_at)) }}
                                </span>
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
                <div class="text-white" data-aos="flip-right">
                    <div class="post-body post-content text-white">
                        <span class="text-white">
                            {!! $article->description !!}
                        </span>

                        <!-- MENAMPILKAN FILE PDF -->
                        @php
    // Ambil PDF utama (jika ada)
    $singlePdf = !empty($article->pdf) ? [$article->pdf] : [];

    // Ambil daftar PDF dari JSON atau string
    $pdfs = [];
    if (!empty($article->pdfs)) {
        $decodedPdfs = json_decode($article->pdfs, true);
        $pdfs = is_array($decodedPdfs) ? $decodedPdfs : explode(',', str_replace(['[', ']', '"'], '', $article->pdfs));
    }

    // Gabungkan semua PDF dalam satu array
    $allPdfs = array_merge($singlePdf, array_map('trim', $pdfs));
@endphp

@if(count($allPdfs) > 0)
    <div class="my-4 px-2 bg-white">
        <ul class="text-black">
            @foreach ($allPdfs as $pdf)
                <li>
                    <a href="{{ Storage::url($pdf) }}" target="_blank" class="flex items-center justify-start">
                        <span class="iconify" data-icon="line-md:download-loop"></span>
                        <span class="filename">{{ basename($pdf) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

                            <!-- END MENAMPILKAN FILE PDF -->

                    </div>
                </div>
            </div>
            <div class="col-xl-4 text-white" data-aos="flip-left">
                <h3 class="text-white">Artikel Lainnya</h3>
                <div class="my-4 text-white">
                    @foreach ($other_articles as $other_article)
                    <div class="flex justify-between items-center w-full space-x-4 space-y-4">
                        <div class="w-auto">
                            <a href="{{ route('post', ['slug' => $other_article->slug]) }}">
                                <img alt="{{ $other_article->title }}" class="w-16 h-16 lazyloaded"
                                    src="{{ Storage::url($other_article->image) }}">
                            </a>
                        </div>
                        <div class="w-full">
                            <a href="{{ route('post', ['slug' => $other_article->slug]) }}" class="text-dark">
                                <h6 class="mb-0 text-white">{{ $other_article->title }}</h6>
                            </a>
                            <div>
                                <small class="text-white">
                                    <a href="{{ route('category', ['slug' => $other_article->category->slug]) }}" target="_blank">
                                        {{ $other_article->category->title }}
                                    </a>
                                </small>
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
