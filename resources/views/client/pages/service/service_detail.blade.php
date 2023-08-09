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
    <h1>Service</h1>
    <p>Vaccine services are an important aspect of public health. They provide access to vaccines that protect against
        infectious diseases and help prevent the spread of illness. Vaccine services may be provided by healthcare
        providers, public health agencies, or community organizations. These services may include administering vaccines,
        providing information about vaccines, and monitoring vaccine safety and effectiveness. By making vaccines accessible
        and promoting vaccine belief, vaccine services help improve public health outcomes and protect individuals and
        communities from preventable diseases.</p>
    <a href="{{ route('client.service.list') }}" class="btn_2">Learn Now</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/service_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <div class="container" style="margin-bottom: 2%">
        @forelse ($serviceClientList as $service)
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2 id="tableservice">{{ $service->name }}</h2>
                    </div>
                </div>
            </div>
            <div class="ui segment">
                {!! $service->description !!}
            </div>
            <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
            <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
        @empty
            <p>No detail</p>
        @endforelse
    </div>
    <div class="container">
        <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="50"></div>
    </div>
@endsection
