@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/about-us"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>About us</h1>
    <p>Our company is committed to providing safe and effective vaccines to people around the world. We work with leading
        healthcare providers and government agencies to ensure that our vaccines meet the highest standards of quality and
        safety. Our team of experts is dedicated to researching and developing new vaccines to address emerging health
        threats and improve public health outcomes. We believe that vaccines are a critical tool in the fight against
        infectious diseases and are committed to making them accessible to all. Our mission is to protect individuals and
        communities from the spread of disease and promote better health for all.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i
                class="share icon"></i>Share FB</a></div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/top_service.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection

@section('content')
    <h1 style="text-align: center">About Us: Our Mission to Promote Vaccination and Protect Public Health</h1>
    <div class="container" style="margin-bottom: 5%">
        <div class="ui segment">
            {!! $content->description ?? '' !!}
        </div>
    </div>
@endsection
