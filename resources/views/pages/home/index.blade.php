@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->
<section class="overflow-hidden bg-cover bg-top bg-no-repeat" style="background-image: url('{{ asset('assets/images/bg-herosection.png') }}');">
<div class="overflow-hidden flex flex-col lg:flex-row justify-between mt-10 mx-5 lg:mx-20 h-auto space-y-10 lg:space-y-0" data-aos-delay="300" data-aos="fade-down">
    <!-- Bagian Logo dan Informasi -->
    <div  class="w-full h-[80%] lg:w-1/2 flex flex-col items-center md:items-start lg:text-left md:ml-20">
        <img class="h-56 w-48 lg:h-[250px] lg:w-[200px]" src="{{ asset('assets/images/LOGO SDM.png') }}" alt="LOGO SDM">
        <h3 class="mt-5 lg:mt-10 font-extrabold text-4xl lg:text-6xl text-white">BIRO</h3>
        <h3 class="font-extrabold text-start text-4xl lg:text-6xl text-white">SDM POLDA BALI</h3>
        <p class="mt-3 lg:mt-5 font-bold text-base lg:text-xl text-white">
            JL.WR SUPRATMAN NO.7, SUMERTA KAUH, KEC.DENPASAR TIM, KOTA DENPASAR, BALI 80236
        </p>
    </div>

    <!-- Bagian Maskot -->
    <div class="w-full h-[100%] md:h-[80%] lg:w-1/2 flex justify-center md:justify-end">
        <img class="h-[100%]" src="{{ asset('assets/images/GARBHA 3D.png') }}" alt="maskot">
    </div>
</div>
</section>


<section class="section-profile overflow-hidden">
<div class="h-auto bg-cover rounded-xl w-full bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/poldabali.jpg') }}');">
        <div class="inset-0 bg-black/90 h-full w-full py-5 px-10">

                <h1 class="text-4xl lg:text-6xl font-bold text-white">PROFILE BIRO SDM</h1>
                <img data-aos-delay="500" data-aos="fade-down-right" class="mt-4 overflow-hidden w-full h-full md:w-full md:h-[50%]" src="{{ asset('assets/images/profilesdm.png') }}" alt="maskot">
            </div>
        </div>
</div>
</section>



<section class="section-profile py-5 px-10 md:p-10">
<div class="h-auto bg-cover rounded-xl w-full ">
            <div class="h-full w-full text-white" data-aos="fade-down" data-aos-delay="1000">
                <h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 underline-offset-[20px] underline">PROFILE KEPALA BIRO SDM</h1>
                <div class="flex flex-col md:flex-row w-full h-full space-y-10 md:space-y-0 items-center">
                    <div class="h-full w-full md:w-[30%] flex justify-center items-center">
                        <div class="bg-red-700 h-[400px]  w-[300px] border-[10px] border-white rounded-t-full flex items-center justify-center p-4">
                        <img src="{{ asset('assets/images/kepalabirosdm.png') }}" alt="Kapolda Bali">
                        </div>
                    </div>


                        <div class="h-full md:w-[70%] space-y-4">
                            <h1 class="text-white h-32 text-sm px-5 md:h-20 pt-2 rounded-full border-[10px] border-white text-center lg:text-xl flex items-center justify-center 2xl:text-3xl bg-red-600">KOMBES POL TRI BISONO SOEMIHARSO, S.I.K., M.H.KARO SDM POLDA BALI</h1>

                            <h1 class="text-black h-32 text-sm text-center lg:text-xl 2xl:text-3xl px-5 md:h-20 py-2 flex items-center justify-center bg-white  rounded-full border-[10px] border-red-700">KEPALA BIRO SUMBER DAYA MANUSIA POLDA BALI</h1>
                        </div>
                </div>
            </div>
</div>
</section>


<!-- slider -->

<div id="default-carousel" class="relative w-[90%] mx-auto my-32" data-carousel="slide"  data-carousel-interval="7000">
    <h1 class="text-3xl lg:text-4xl font-bold text-white mb-10 underline-offset-[20px] underline">PROFILE KEPALA BAGIAN BIRO SDM</h1>
    <!-- Carousel wrapper -->
    <div class="relative h-[900px] overflow-hidden rounded-lg md:h-[420px]">
        <!-- Loop through each slider data -->
        @foreach($sliders as $index => $slider)
            <!-- Item -->
            <div  class="hidden duration-790 ease-in-out -z-20" data-carousel-item @class(['active' => $index === 0])>
            <div class="md:px-20 flex flex-col md:flex-row w-full h-full space-y-10 space-x-0 md:space-x-10 md:space-y-0  items-center" >
                    <div class="h-full w-full md:w-[30%] flex  justify-center items-center">
                        <div class="bg-red-700 h-[400px]  w-[300px] border-[10px] border-white rounded-t-full flex items-center justify-center p-4">
                        <img src="{{ asset('assets/images/'.$slider['image']) }}" alt="Kapolda Bali">
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

    <!-- Slider indicators -->

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

@stop