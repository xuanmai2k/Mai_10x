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
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a></div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/blog_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area ">
        <div class="container">
            {{-- title --}}
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>List Blog</h2>
                    </div>
                </div>
            </div>
            {{-- search --}}
            <div class="container" style="margin-bottom: 2%">
                <form method="GET">
                    <div class="ui action input">
                        <input type="text" placeholder="Search..." name="keyword"
                            value="{{ is_null(request()->keyword) ? '' : request()->keyword }}">
                        <button type="submit" class="ui icon button"><i class="search icon"></i></button>
                    </div>
                </form>
            </div>
            {{-- content --}}
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    @forelse ($blogClientList as $blogclient)
                        <div class="blog_left_sidebar">
                            <article class="blog_item" style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
                                <div class="blog_item_img">
                                    @php
                                        $imageLink = is_null($blogclient->image_url) || !file_exists('images/admin/blog/' . $blogclient->image_url) ? 'default-image.jpg' : $blogclient->image_url;
                                    @endphp
                                    <img class="card-img rounded-0" src="{{ asset('images/admin/blog/' . $imageLink) }}"
                                        alt="{{ $blogclient->name }}" height="400px" width="100%">
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{ route('client.blog.show', ['slug' => $blogclient->slug]) }}">
                                        <h2>{{ $blogclient->name }}</h2>
                                    </a>
                                    <p>{{ $blogclient->short_description }}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="far fa-user"></i>Time:
                                                {{ $blogclient->created_at }}</a></li>
                                        {{-- <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li> --}}
                                    </ul>
                                </div>
                            </article>
                        </div>
                    @empty
                        No Blog
                    @endforelse
                    <div class="clearfix" style="margin: 2% 0%">
                        {{ $blogClientList->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
