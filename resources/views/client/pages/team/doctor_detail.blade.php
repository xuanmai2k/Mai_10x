@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/doctor"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Doctor</h1>
    <p>Doctors play a crucial role in promoting vaccination and ensuring their patients' health. They are responsible for
        providing accurate information about vaccines, addressing concerns or questions, and administering vaccinations
        safely and effectively. Doctors are also instrumental in identifying individuals who may be at higher risk for
        certain diseases and recommending appropriate vaccines to protect them. By building trust and promoting vaccine
        belief, doctors can help improve vaccination rates and reduce the spread of infectious diseases. Their expertise and
        dedication to promoting public health make them essential partners in the fight against preventable illnesses.</p>
    <a href="{{ route('client.doctor.list') }}" class="btn_2">Learn Now</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/doctor_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!--::doctor_part start::-->
    <section class="doctor_part single_page_doctor_part">
        <div class="container" style="margin-bottom: 2%">
            @forelse ($doctorClientList as $doctor)
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section_tittle text-center">
                            <h2 id="tableservice">{{ $doctor->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    {!! $doctor->information !!}
                </div>
                <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
            @empty
                <p>No detail doctor</p>
            @endforelse
        </div>
        <div class="container">
            <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="50"></div>
        </div>
    </section>
@endsection
