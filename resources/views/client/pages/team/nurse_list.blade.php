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
    <p>Nurses are an essential part of the vaccination process, playing a critical role in promoting and administering vaccines. They are responsible for educating patients about the benefits of vaccination, addressing any concerns or questions, and ensuring that vaccines are administered safely and effectively. Nurses also play a key role in monitoring patients for any adverse reactions to vaccines and providing appropriate care if needed. Their expertise and dedication to promoting public health make them valuable partners in the fight against infectious diseases. By working closely with doctors and other healthcare professionals, nurses help ensure that as many people as possible have access to life-saving vaccines.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a>
    </div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/nurse_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp" data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!--::nurse_part start::-->
    <section class="doctor_part single_page_doctor_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2> Experienced Nurses</h2>
                        <p>Experienced nurses are highly trained medical professionals who have years of experience working
                            in healthcare. They possess a deep understanding of patient care, medication management, and
                            treatment protocols. They are able to provide compassionate care to patients, educate them about
                            their health conditions, and assist doctors in medical procedures.</p>
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
            {{-- content --}}
            <div class="ui three column grid">
                @forelse ($nurseClientList as $nurseclient)
                    <div class="column">
                        <div class="ui cards">
                            <div class="card">
                                <div class="content">
                                    @php
                                        $imageLink = is_null($nurseclient->image_url) || !file_exists('images/admin/nurse/' . $nurseclient->image_url) ? 'default-image.jpg' : $nurseclient->image_url;
                                    @endphp
                                    <img class="right floated mini ui image"
                                        src="{{ asset('images/admin/nurse/' . $imageLink) }}"
                                        alt="{{ $nurseclient->name }}">
                                    <div class="header">
                                        {{ $nurseclient->name }}
                                    </div>
                                    <div class="meta">
                                        {{ $nurseclient->position }}
                                    </div>
                                    <div class="description">
                                        Elliot requested permission to view your contact details
                                    </div>
                                </div>
                                <div class="extra content">
                                    <div class="ui one buttons">
                                        <a href="{{ route('client.nurse.show', ['slug'=> $nurseclient->slug]) }}" class="ui basic green button">Detail</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div>No Nurse</div>
                @endforelse
            </div>
            <div class="clearfix" style="margin: 2% 0%">
                {{ $nurseClientList->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
    <!--::nurse_part end::-->
@endsection
