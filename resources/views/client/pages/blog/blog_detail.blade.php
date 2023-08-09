@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/blog"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Blog</h1>
    <p>A blog academy that focuses on vaccines can play a critical role in promoting public health and raising awareness
        about the importance of vaccination. Through educational articles, blog posts, and other content, a vaccine-focused
        blog academy can provide accurate information about vaccines, address common concerns and misconceptions, and
        promote vaccine belief. By working with healthcare professionals and public health organizations, a blog academy can
        help increase understanding of the benefits of vaccination and encourage more people to get vaccinated. This can
        ultimately lead to better health outcomes for individuals and communities by reducing the spread of infectious
        diseases.</p>
    <a href="{{ route('client.blog.list') }}" class="btn_2">Learn Now</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/blog_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <section>
        <div class="container" style="margin-bottom: 2%">
            @forelse ($blogClientList as $blog)
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section_tittle text-center">
                            <h2 id="tableservice">{{ $blog->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    {!! $blog->description !!}
                </div>
                <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
            @empty
                <p>No detail blog</p>
            @endforelse
        </div>
        <div class="container">
            <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="50"></div>
        </div>
    </section>
@endsection
