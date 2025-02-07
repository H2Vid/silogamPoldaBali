@extends ('layouts.master')

@section ('content')
<!-- Main Wrapper -->
<?php
$per_page = 12;
?>

    <div class="bg-[url('/public/assets/images/LOGO_SDM.png')] bg-no-repeat bg-center mt-10 w-full h-[400px] py-10">
        <div class="bg-white/5 border backdrop-filter backdrop-blur-lg w-full h-full  rounded-3xl drop-shadow-2xl shadow-2xl  flex flex-col justify-center items-center space-y-6">
            <div class="flex flex-col justify-center items-center space-y-8 ">
                <p class="text-white font-black text-2xl md:text-[40px]">SELAMAT DATANG DI WEBSITE RESMI</p>
                <p class="text-white font-black text-2xl md:text-[40px]">BIRO SUMBER DAYA MANUSIA DAERAH BALI</p>
            </div>
            <div class="flex justify-center items-center space-x-6">
                <p class="text-white font-black text-[16px] border p-2 rounded-3xl drop-shadow-2xl">Melindungi</p>
                <p class="text-white font-black text-[16px] border p-2 rounded-3xl drop-shadow-2xl">Mengayomi</p>
                <p class="text-white font-black text-[16px] border p-2 rounded-3xl drop-shadow-2xl">Melayani</p>
            </div>

        </div>
        </div>


<div class="article my-5 mx-10 ">


     <?php
       $article_data = Article::getAllBuilder(Auth::guard('cms')->check(), $current_category->id ?? null, $keyword)->orderBy('id', 'DESC')->paginate($per_page);
     ?>
    <div data-aos="fade-up-right" class=" grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 mx-4">

    @foreach ($article_data as $article)
            <div  class="p-3 bg-white/5 h-[480px] backdrop-filter backdrop-blur-3xl border border-gray-900 rounded-lg shadow-sm ">
                <a href="{{ route('post', ['slug' => $article->slug]) }}">
                    <img class="h-[220px] w-full rounded-lg" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" />
                </a>
                <div class="">
                    <a href="{{ route('post', ['slug' => $article->slug]) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white line-clamp-2">{{ $article->title }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-white line-clamp-4">{{ descriptionMaker($article->excerpt) }}
                    </p>
                    <div class="absolute bottom-2 ">
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


                <div class="d-flex  w-[30%] mt-10 mx-auto {{ $article_data->currentPage() > 1 && $article_data->hasMorePages() ? 'justify-content-between' : 'justify-content-center' }}">
                    @if ($article_data->currentPage() > 1)
                    <div class="blog-pager" id="blog-pager">
                        <div class="list-inline">
                            <a class="blog-pager-older-link list-inline-item" href="{{ $article_data->previousPageUrl() }}" title="More posts">
                                <div class="text-white fbt-bp-message text-uppercase font-weight-bold"><span aria-hidden="true" class="fa fa-angle-left"></span> Prev</div>
                            </a>
                        </div>
                    </div>
                    @endif
                    @if ($article_data->hasMorePages())
                    <div class="blog-pager" id="blog-pager">
                        <div class="list-inline">
                            <a class="blog-pager-older-link list-inline-item" href="{{ $article_data->nextPageUrl() }}" title="More posts">
                                <div class="text-white fbt-bp-message text-uppercase font-weight-bold">Next Page <span aria-hidden="true" class="fa fa-angle-right"></span></div>
                            </a>
                        </div>
                    </div>
                    @endif

                </div>

                <br><br>
            </div>

        </div>
    </div><!-- #main-wrapper -->

</div><!-- .fbt-main-wrapper -->
@stop

@push ('script')
<script>
$(function() {
    handleCardHeight();
});

function handleCardHeight()
{
    if ($(window).width() > 768) {
        h = 0;
        $('.fbt-post-caption.card-body').each(function() {
            if ($(this).height() > h) {
                h = $(this).height();
            }
        });
        $('.fbt-post-caption.card-body').height(h);
    }
}
</script>
@endpush