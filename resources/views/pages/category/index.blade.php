@extends('layouts.master')

@section('content')
<section class="mt-10">
    <!-- Bagian ATAS (selalu tampil) -->
    <div id="default-carousel" class="bagianATAS relative" data-carousel="slide"  data-carousel-interval="7000">
        <div class="relative h-[900px] z-0 overflow-hidden rounded-lg md:h-[500px]">
            @foreach($banners as $index => $banner)
                <div class="bg-red-500 hidden duration-790 ease-in-out z-0" data-carousel-item @class(['active' => $index === 0])>
                    <img class="w-full h-full" src="{{ asset('assets/images/'.$banner['image']) }}" alt="Banner">
                </div>
            @endforeach
        </div>
        <!-- Banner controls -->
        <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Bagian BAWAH (selalu tampil) -->
    @php
        $activeKabag = collect($dataKabag)->firstWhere('slug', $slug);
    @endphp
    <div class="bagianBAWAH h-auto bg-cover rounded-xl w-full mt-20">
        <div class="h-full w-full text-white" data-aos="fade-down">
            <div class="flex flex-col md:flex-row w-full h-full space-y-10 md:space-y-0 items-center">
                <div class="h-full w-full md:w-[30%] flex justify-center items-center">
                <div class="{{ request()->is('subcategory/*') ? 'bg-blue-700' : 'bg-red-700' }} h-[400px] w-[300px] border-[10px] border-white rounded-t-full flex items-end justify-center">
                    <img src="{{ asset('assets/images/' . ($activeKabag ? $activeKabag['image'] : 'kepalabirosdm.png')) }}" alt="Kapolda Bali">
                </div>
                </div>
                <div class="h-full md:w-[70%] space-y-4 px-5">
                    <h1 class="text-white h-32 text-sm px-5 md:h-20 pt-2 rounded-full border-[10px] border-white text-center lg:text-xl flex items-center justify-center 2xl:text-3xl bg-red-600">
                        {{ $activeKabag ? $activeKabag['title'] : 'KOMBES POL TRI BISONO SOEMIHARSO, S.I.K., M.H. KARO SDM POLDA BALI' }}
                    </h1>
                    <h1 class="text-black h-32 text-sm text-center lg:text-xl 2xl:text-3xl px-5 md:h-20 py-2 flex items-center justify-center bg-white rounded-full border-[10px] border-red-700">
                        {{ $activeKabag ? $activeKabag['subtitle'] : 'KEPALA BIRO SUMBER DAYA MANUSIA POLDA BALI' }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="article my-5 mx-10">
        <h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 px-4">ARTIKEL TERKAIT</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 mx-4">
            @foreach ($articles as $article)
                <div class="p-3 bg-white/5 h-[480px] backdrop-filter backdrop-blur-3xl border border-gray-900 rounded-lg shadow-sm">
                    <a href="{{ route('post', ['slug' => $article->slug]) }}">
                        <img class="h-[220px] w-full rounded-lg" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" />
                    </a>
                    <div class="">
                        <a href="{{ route('post', ['slug' => $article->slug]) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white line-clamp-2">{{ $article->title }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-white line-clamp-4">{{ descriptionMaker($article->excerpt) }}</p>
                        <div class="absolute bottom-2">
                            <a href="{{ route('post', ['slug' => $article->slug]) }}"
                               class="inline-flex items-center px-4 py-2 text-sm lg:text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Baca Selengkapnya
                                <svg class="rtl:rotate-180 w-4 h-4 ms-2 lg:w-5 lg:h-5"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 14 10">
                                    <path stroke="currentColor"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex w-[30%] mt-10 mx-auto {{ $articles->currentPage() > 1 && $articles->hasMorePages() ? 'justify-content-between' : 'justify-content-center' }}">
            @if ($articles->currentPage() > 1)
                <div class="blog-pager" id="blog-pager">
                    <div class="list-inline">
                        <a class="blog-pager-older-link list-inline-item" href="{{ $articles->previousPageUrl() }}" title="More posts">
                            <div class="text-white fbt-bp-message text-uppercase font-weight-bold"><span aria-hidden="true" class="fa fa-angle-left"></span> Prev</div>
                        </a>
                    </div>
                </div>
            @endif
            @if ($articles->hasMorePages())
                <div class="blog-pager" id="blog-pager">
                    <div class="list-inline">
                        <a class="blog-pager-older-link list-inline-item" href="{{ $articles->nextPageUrl() }}" title="More posts">
                            <div class="text-white fbt-bp-message text-uppercase font-weight-bold">Next Page <span aria-hidden="true" class="fa fa-angle-right"></span></div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
