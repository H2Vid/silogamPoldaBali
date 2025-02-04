@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->
<section <sectionp-10  class="overflow-hidden bg-cover  bg-top bg-no-repeat" style="background-image: url('{{ asset('assets/images/bg-herosection.png') }}');">
<divbg-red-500 class="overflow-hidden flex flex-col lg:flex-row justify-between mt-10 mx-5 lg:mx-20 h-auto space-y-10 lg:space-y-0" data-aos-delay="300" data-aos="fade-down">
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
</divbg-red-500>
</section>


<section class="section-profile overflow-hidden">
<div class="h-auto bg-cover rounded-xl w-full bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/poldabali.jpg') }}');">
        <div class="inset-0 bg-black/90 h-full w-full py-5 px-10">
text-white">
                <h1 class="text-4xl lg:text-6xl font-bold text-white">PROFILE BIRO SDM</h1>
                <img data-aos-delay="500" data-aos="fade-down-right" class="mt-4 overflow-hidden w-full h-full md:w-full md:h-[50%]" src="{{ asset('assets/images/profilesdm.png') }}" alt="maskot">
            </div>
        </div>
</div>
</section>



<section class="section-profile py-5 px-10 md:p-10">
<div class="h-auto bg-cover rounded-xl w-full ">
            <div class="h-full w-full text-white" data-aos="fade-down" data-aos-delay="1000">
                <h1 class="text-4xl lg:text-6xl font-bold text-white">PROFILE KEPALA BIRO SDM</h1>
                <div class="flex flex-col md:flex-row w-full h-full space-y-10 md:space-y-0 justify-between items-center">
                        <img class="w-full h-full md:w-[50%] md:h-[50%]" src="{{ asset('assets/images/polisisdm.png') }}" alt="Kapolda Bali">
                        <div >
                            <h1 class="text-white p-2 h-20 text-center md:text-2xl  flex items-center justify-center  bg-red-600">KOMBES POL.TRI BISONO SOEMIHARSO,S.I.K,M.H. KARO SDM POLDA BALI</h1>
                            <h1 class="text-black h-20  text-center md:text-2xl p-2 flex items-center justify-center bg-white">KEPALA BIRO SUMBER DAYA MANUSIA POLDA BALI</h1>
                        </div>
                </div>
            </div>
</div>
</section>

<!-- .fbt-main-wrapper -->
@stop