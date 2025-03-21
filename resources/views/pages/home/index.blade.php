@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->
<section class="overflow-hidden bg-cover bg-top bg-no-repeat" style="background-image: url('{{ asset('assets/images/bg-herosection.png') }}');">
<div class="overflow-hidden flex flex-col lg:flex-row justify-between mt-10 mx-2 md:mx-5 lg:mx-10h-auto space-y-10 lg:space-y-0" data-aos-delay="300" data-aos="fade-down">
    <div class="h-auto w-full lg:w-[60%] md:pl-5">
    <img class="h-56 w-48 lg:h-[250px] lg:w-[200px]" src="{{ asset('assets/images/LOGO SDM.png') }}" alt="LOGO SDM">
    <div class="w-auto inline-block">
            <h3 class="mt-5 lg:mt-10 font-extrabold text-4xl lg:text-5xl text-white font-horta">BIRO</h3>
            <h3 class="font-extrabold text-start text-4xl lg:text-5xl text-white font-horta">SDM POLDA BALI</h3>
            <p class="mt-3 lg:mt-5 font-bold text-base lg:text-lg text-white">
                JL. WR SUPRATMAN NO. 7, SUMERTA KAUH, KEC. DENPASAR TIMUR, KOTA DENPASAR, BALI 80236
            </p>
            <div class="h-32 w-[100%] lg:h-48 md:w-[105%] lg:w-[105%] xl:w-[100%] custom:w-[107%] flex items-center justify-end">
                <img class="h-full w-[30%]" src="{{ asset('assets/images/DHARMA-01.png') }}" alt="DHARMA">
                <img class="h-full w-[70%] flex justify-end items-end" src="{{ asset('assets/images/logo-presisi-png-3.png') }}" alt="PRESISI">
            </div>
        </div>
    </div>
    <div class="h-auto w-full lg:w-[40%]">
    <img src="{{ asset('assets/images/GARBHA 3D.png') }}" alt="maskot">
    </div>
</div>
</section>

<section class="profile_SDM ">
<div class="h-auto bg-cover w-full bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/poldabali.jpg') }}');">
<div class="inset-0 bg-black/70 h-full w-full py-5 px-10">
<h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 underline">PROFILE BIRO SDM</h1>
<div id="default-carousel" class="relative w-full " data-carousel="slide" data-aos="fade-down" data-aos-delay="1000" data-aos-easing="linear" data-aos-duration="700">
    <!-- Carousel wrapper -->
    <div class="relative -z-30 h-56 overflow-hidden rounded-lg md:h-[500px] xl:h-[800px] 2xl:h-[900px]">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img class="mt-4 overflow-hidden w-full h-full md:w-full md:h-[100%]" src="{{ asset('assets/images/profilesdm.png') }}" alt="maskot">
        </div>
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img data-aos-delay="500" data-aos="fade-down-right" class="mt-4 overflow-hidden w-full h-full md:w-full md:h-[100%]" src="{{ asset('assets/images/profilesdm2.png') }}" alt="maskot">
        </div>
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img data-aos-delay="500" data-aos="fade-down-right" class="mt-4 overflow-hidden w-full h-full md:w-full md:h-[100%]" src="{{ asset('assets/images/profilesdm3.png') }}" alt="maskot">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
</div>
</div>

</section>

<section class="section-profile">

<div class="h-auto bg-cover w-full bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/2.png') }}');">
<div class="inset-0 bg-black/70 h-full w-full py-5">

<div class="h-auto bg-cover rounded-xl w-full px-10">
            <div class="h-full w-full text-white" data-aos="fade-down" data-aos-delay="1000" data-aos-easing="linear" data-aos-duration="700">
                <h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 underline">PROFILE KEPALA BIRO SDM</h1>
                <div class="flex flex-col md:flex-row w-full h-full space-y-10 md:space-y-0 items-center">
                    <div class="h-full w-full md:w-[30%] flex justify-center items-center">
                    <div class="bg-red-700 h-[400px] md:h-[370px] 2xl:h-[420px] w-[300px] border-[10px] border-white rounded-t-full flex items-end justify-center">
                        <img src="{{ asset('assets/images/kepalabirosdm.png') }}" alt="Kapolda Bali">
                        </div>
                    </div>
                        <div class="h-full md:w-[70%] space-y-4">
                            <h1 class="text-white h-32 text-sm px-5 md:h-20 pt-2 rounded-full border-[10px] border-white text-center lg:text-xl flex items-center justify-center 2xl:text-3xl bg-red-600">KOMBES POL TRI BISONO SOEMIHARSO, S.I.K., M.H</h1>

                            <h1 class="text-black h-32 text-sm text-center lg:text-xl 2xl:text-3xl px-5 md:h-20 py-2 flex items-center justify-center bg-white  rounded-full border-[10px] border-red-700">KEPALA BIRO SUMBER DAYA MANUSIA POLDA BALI</h1>
                        </div>
                </div>
            </div>
            </div>
            </div>
</div>
</section>


<!-- slider -->
<section class="slider">
<div class="h-auto bg-cover rounded-xl w-full bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/bgSlider.jpg') }}');">
<div class="inset-0 bg-black/80 h-full w-full py-5">
<div id="default-carousel" class="relative w-full mx-auto my-32" data-carousel="slide"  data-carousel-interval="7000" data-aos="fade-down" data-aos-delay="1000" data-aos-easing="linear" data-aos-duration="700">
    <h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 underline px-10">PROFILE KEPALA BAGIAN BIRO SDM</h1>
    <!-- Carousel wrapper -->
    <div class="relative h-[900px] -z-30 overflow-hidden rounded-lg md:h-[420px]">
        <!-- Loop through each slider data -->
        @foreach($sliders as $index => $slider)
            <!-- Item -->
            <div  class="hidden " data-carousel-item @class(['active' => $index === 0])>
            <div class="md:px-20 flex flex-col md:flex-row w-full h-full space-y-10 space-x-0 md:space-x-10 md:space-y-0  items-center" >
                    <div class="h-full w-full md:w-[30%] flex  justify-center items-center">
                    <div class="bg-red-700 h-[400px] md:h-[310px] lg:h-[390px] w-[300px] border-[10px] border-white rounded-t-full flex items-end justify-center">
                        <img  src="{{ asset('assets/images/'.$slider['image']) }}" alt="Kapolda Bali">
                        </div>
                    </div>
                        <div class="h-full lg:w-[70%] w-full  flex flex-col justify-center items-center space-y-4">
                            <h1 class="w-full text-white h-32 text-sm px-5 md:h-20 pt-2 rounded-full border-[10px] border-white text-center lg:text-xl flex items-center justify-center 2xl:text-3xl bg-red-600">{{ $slider['title'] }}</h1>
                            <h1 class="w-full text-black h-32 text-sm text-center lg:text-xl 2xl:text-3xl px-5 md:h-20 py-2 flex items-center justify-center bg-white  rounded-full border-[10px] border-red-700">{{ $slider['subtitle'] }}</h1>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
</div>
</div>

</section>

<!-- akhir sliders -->



<!-- Banner -->
<section class="px-10 mt-20">
<div id="default-carousel" class="relative " data-carousel="slide"  data-carousel-interval="7000" data-aos="fade-down" >
    <!-- Carousel wrapper -->
    <div class="relative  h-56 -z-30 overflow-hidden rounded-lg md:h-[500px]">
        <!-- Loop through each banners data -->
        @foreach($banners as $index => $banner)
            <!-- Item -->
            <div class="bg-red-500 hidden duration-790 ease-in-out " data-carousel-item @class(['active' => $index === 0])>
                        <img class="w-full h-full" src="{{ asset('assets/images/'.$banner['image']) }}" alt="Banner">
            </div>
        @endforeach
    </div>
    <!-- banner controls -->
    <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 group-hover:bg-yellow-500/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
</section>
<!-- akhir banners -->


<!-- artikel terbaru -->
<section class="px-10 mt-20">
<h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 px-4">ARTIKEL TERBARU</h1>
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
</section>
<!-- akhir artikel terbaru -->
@stop