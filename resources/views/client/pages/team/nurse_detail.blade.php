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
    <h1>Nurse</h1>
    <p>Nurses are an essential part of the vaccination process, playing a critical role in promoting and administering
        vaccines. They are responsible for educating patients about the benefits of vaccination, addressing any concerns or
        questions, and ensuring that vaccines are administered safely and effectively. Nurses also play a key role in
        monitoring patients for any adverse reactions to vaccines and providing appropriate care if needed. Their expertise
        and dedication to promoting public health make them valuable partners in the fight against infectious diseases. By
        working closely with doctors and other healthcare professionals, nurses help ensure that as many people as possible
        have access to life-saving vaccines.</p>
    <a href="{{ route('client.nurse.list') }}" class="btn_2">Learn Now</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/nurse_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <section class="doctor_part single_page_doctor_part">
        <div class="container" style="margin-bottom: 2%">
            @forelse ($nurseClientList as $nurse)
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section_tittle text-center">
                            <h2 id="tableservice">{{ $nurse->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    {!! $nurse->information !!}
                </div>
                <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
            @empty
                <p>No detail nurse</p>
            @endforelse
        </div>
        <div class="container">
            <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="50"></div>
        </div>
    </section>
@endsection
