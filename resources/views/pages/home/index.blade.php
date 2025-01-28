@extends ('layouts.master')

@push ('hero')
    @include ('pages.home.slider')
@endpush

@section ('content')
<!-- Main Wrapper -->
<div class="flex flex-col lg:flex-row justify-between mt-10 mx-5 lg:mx-20 h-auto space-y-10 lg:space-y-0" >
    <!-- Bagian Logo dan Informasi -->
    <div class="w-full h-[80%] lg:w-1/2 flex flex-col items-center md:items-start lg:text-left md:ml-20">
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


<section class="section-profile">
<div class="h-auto bg-cover rounded-xl w-full bg-opacity-10 bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/poldabali.jpg') }}');">
        <div class="inset-0 bg-black/90 h-full w-full py-5 px-10">
            <div class="h-full w-full text-white">
                <h1 class="text-4xl lg:text-6xl font-bold text-white">PROFILE BIRO SDM</h1>
                <div class="flex flex-col md:flex-row w-full h-full justify-between items-center">
                        <img class="w-full h-full md:w-[50%] md:h-[50%]" src="{{ asset('assets/images/GARBHA 3D.png') }}" alt="maskot">
                        <p class="w-full h-auto text-justify text-[16px] indent-10">
                            Polisi Daerah (Polda) adalah lembaga kepolisian yang berperan penting dalam menjaga keamanan, ketertiban, dan penegakan hukum di wilayah tertentu. Sebagai garda terdepan pelayanan masyarakat, Polda berkomitmen untuk menciptakan lingkungan yang aman, harmonis, dan kondusif bagi seluruh warga.
                            Didukung oleh personel yang profesional, berdedikasi tinggi, dan menjunjung tinggi nilai-nilai integritas, Polda menjalankan tugas-tugas meliputi perlindungan masyarakat, penanganan kasus kriminal, pengawasan lalu lintas, hingga pelaksanaan program-program kemasyarakatan yang bersifat preventif dan edukatif.

                            Dengan semboyan **"Melindungi, Mengayomi, dan Melayani"**, Polisi Daerah senantiasa hadir untuk menjawab kebutuhan masyarakat dalam menjaga keamanan, ketertiban, serta mewujudkan keadilan di setiap lapisan kehidupan. Polda terus berinovasi dalam pelayanan publik, memastikan bahwa masyarakat merasa terlindungi dan percaya pada sistem hukum yang adil.

                            Sebagai mitra masyarakat, Polda juga aktif membangun hubungan yang harmonis melalui kolaborasi dengan berbagai pihak, menciptakan sinergi demi mewujudkan wilayah yang damai, aman, dan sejahtera.
                        </p>
                </div>
            </div>
        </div>
</div>
</section>



<section class="section-profile p-10">
<div class="h-auto bg-cover rounded-xl w-full ">
            <div class="h-full w-full text-white">
                <h1 class="text-4xl lg:text-6xl font-bold text-white">PROFILE BIRO SDM</h1>
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