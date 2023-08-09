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
    <p>Doctors play a crucial role in promoting vaccination and ensuring their patients' health. They are responsible for providing accurate information about vaccines, addressing concerns or questions, and administering vaccinations safely and effectively. Doctors are also instrumental in identifying individuals who may be at higher risk for certain diseases and recommending appropriate vaccines to protect them. By building trust and promoting vaccine belief, doctors can help improve vaccination rates and reduce the spread of infectious diseases. Their expertise and dedication to promoting public health make them essential partners in the fight against preventable illnesses.</p>
    {{-- share --}}
    <div class="fb-share-button" data-href="{{ $url_canonical }}" data-layout="" data-size=""><a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}" class="fb-xfbml-parse-ignore btn_2"><i class="share icon"></i>Share FB</a></div>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/doctor_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!--::doctor_part start::-->
    <section class="doctor_part single_page_doctor_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2> Experienced Doctor</h2>
                        <p>Experienced doctor are highly trained medical professionals who have years of experience working
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
                @forelse ($doctorClientList as $doctorclient)
                    <div class="column">
                        <div class="ui cards" style="height: 100%" >
                            <div class="card">
                                <div class="content">
                                    @php
                                        $imageLink = is_null($doctorclient->image_url) || !file_exists('images/admin/doctor/' . $doctorclient->image_url) ? 'default-image.jpg' : $doctorclient->image_url;
                                    @endphp
                                    <img class="right floated mini ui image"
                                        src="{{ asset('images/admin/doctor/'.$imageLink) }}"
                                        alt="{{ $doctorclient->name }}">
                                    <div class="header">
                                        {{ $doctorclient->name }}
                                    </div>
                                    <div class="meta">
                                        {{ $doctorclient->position }}
                                    </div>
                                    <div class="description">
                                        Elliot requested permission to view your contact details
                                    </div>
                                </div>
                                <div class="extra content">
                                    <div class="ui one buttons">
                                        <a href="{{ route('client.doctor.show', ['slug' => $doctorclient->slug]) }}" class="ui basic green button">Detail</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div>No Doctor</div>
                @endforelse
            </div>
            <div class="clearfix" style="margin: 2% 0%">
                {{ $doctorClientList->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
    <!--::doctor_part end::-->
@endsection




{{-- <div class="single_blog_item">
    <div class="single_blog_img">
        <img src="{{ asset('client/img/doctor/doctor_4.png') }}" alt="doctor">
        <div class="social_icon">
            <ul>
                <li><a href="#"> <i class="ti-facebook"></i> </a></li>
                <li><a href="#"> <i class="ti-twitter-alt"></i> </a></li>
                <li><a href="#"> <i class="ti-instagram"></i> </a></li>
                <li><a href="#"> <i class="ti-skype"></i> </a></li>
            </ul>
        </div>
    </div>
    <div class="single_text">
        <div class="single_blog_text">
            <h3>DR Adam Billiard</h3>
            <p>Heart specialist</p>
        </div>
    </div>
</div> --}}
