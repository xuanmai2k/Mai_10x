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
    <p>Believing in the power of vaccines is crucial to promoting public health. Vaccines have been proven to be safe and effective in preventing the spread of infectious diseases and have played a key role in reducing the prevalence of many dangerous illnesses. However, vaccine hesitancy remains a challenge in some communities. It is important to provide accurate information about vaccines and address concerns in order to build trust and encourage vaccination. By promoting vaccine belief, we can help ensure that more people have access to the protection and benefits that vaccines offer, ultimately leading to better health outcomes for individuals and society as a whole.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a>
    </div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/vaccine_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection

@section('content')
    {{-- title --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2> List Vaccine </h2>
                    <p>Face replenish sea good winged bearing years air divide wasHave night male also</p>
                </div>
            </div>
        </div>
    </div>

    {{-- search --}}
    <div class="container" style="margin-bottom: 2%">
        <form  method="GET">
            <div class="ui action input">
                <input type="text" placeholder="Search..." name="keyword" value="{{ is_null(request()->keyword) ? '' : request()->keyword}}">
                <button type="submit" class="ui icon button"><i class="search icon"></i></button>
              </div>
        </form>
    </div>

    {{-- list vaccine --}}
    <div class="container" style="margin-bottom: 2% ;">
        <div class="ui four column stackable grid">
            @forelse ($vaccineClientList as $vaccineclient)
                <div class="column"  >
                    <a class="ui card" href="{{ route('client.vaccine.show', ['slug' => $vaccineclient->slug]) }}" style="height: 100%" >
                        <div class="content">
                          <div class="header">{{ $vaccineclient->name_product }}</div>
                          <div class="meta">
                            <span class="category"><p>Price: {{ $vaccineclient->price }} vnd</p></span>
                          </div>
                          <div class="description">
                            <p>{{ $vaccineclient->category->name }}</p>
                          </div>
                        </div>
                        <div class="extra content">
                          <div class="right floated author">
                                @php
                                    $imageLink = is_null($vaccineclient->image_url) || !file_exists('images/admin/vaccine/' . $vaccineclient->image_url) ? 'default-image.jpg' : $vaccineclient->image_url;
                                @endphp
                            <img class="ui avatar image" src="{{ asset('images/admin/vaccine/'.$imageLink) }}" alt="{{ $vaccineclient->name }}" > Image
                          </div>
                        </div>
                    </a>
                </div>
            @empty
                <div>No Vaccine</div>
            @endforelse
        </div>
        <div class="clearfix" style="margin: 2% 0%" >
            {{ $vaccineClientList->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
