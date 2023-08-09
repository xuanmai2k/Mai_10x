@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    {{-- <meta property="og:site_name" content="http://127.0.0.1:8000/vaccine"> --}}
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="link image" /> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>We are here for your care</h5>
    <h1>Vaccine</h1>
    <p>Believing in the power of vaccines is crucial to promoting public health. Vaccines have been proven to be safe and
        effective in preventing the spread of infectious diseases and have played a key role in reducing the prevalence of
        many dangerous illnesses. However, vaccine hesitancy remains a challenge in some communities. It is important to
        provide accurate information about vaccines and address concerns in order to build trust and encourage vaccination.
        By promoting vaccine belief, we can help ensure that more people have access to the protection and benefits that
        vaccines offer, ultimately leading to better health outcomes for individuals and society as a whole.</p>
    <a href="{{ route('client.vaccine.list') }}" class="btn_2">Learn Now</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/vaccine_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection

@section('content')
    <section>
        <div class="container" style="margin-bottom: 2%">
            @forelse ($vaccineClientList as $vaccine)
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section_tittle text-center">
                            <h2 id="tableservice">{{ $vaccine->name_product }}</h2>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    {!! $vaccine->description !!}
                </div>
                <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
            @empty
                <p>No detail vaccine</p>
            @endforelse
        </div>
        <div class="container">
            <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="100%" data-numposts="50"></div>
        </div>
    </section>
@endsection
