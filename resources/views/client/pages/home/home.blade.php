@extends('client.layout.master')

@section('seo')
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="description" content="{{ $meta_desc }}">
    <link rel="canonical" href="{{ $url_canonical }}">
    <!-- Share FB -->
    <meta property="og:site_name" content="http://127.0.0.1:8000/home">
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="MaiVaccine">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:image" content="{{ link image }}"> --}}
@endsection

@section('titleIntroAndButtonBanner')
    <h5>{{ __('We are here for your care') }}</h5> <!--We are here for your care-->
    <h1>{{ __('Best Vaccine & Better Doctor') }}</h1>
    <p>{{ __("MaiVaccine is your go-to platform for finding reliable information on the latest vaccines and trusted healthcare providers. We understand the importance of making informed decisions about your health, which is why we provide a wealth of resources to help you choose the right vaccine and doctor for your needs. Whether you're looking for routine vaccinations or specialized medical care, we're here to help connect you with the best possible resources to achieve optimal health outcomes. Trust in our expertise and experience to guide you towards a healthier future.") }}</p>
    <a href="{{ route('appointment.index') }}" class="btn_2">{{ __('Make an appointment') }}</a>
@endsection


@section('imageBanner')
    <img src="{{ asset('client/img/banner_img.jpg') }}" alt="" class="aos-init animated animate__fadeInUp"
        data-aos="fade-up" data-aos-duration="1000">
@endsection


@section('content')
    <!-- about us part start-->
    <section class="about_us padding_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="about_us_img">
                        <img src="{{ asset('client/img/top_service.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="about_us_text">
                        <h2>About Us</h2>
                        <p>At our website, we are dedicated to providing reliable and up-to-date information on vaccines.
                            Our team of experts work tirelessly to ensure that you have access to the latest research, news,
                            and recommendations on vaccines. We understand the importance of making informed decisions about
                            your health, and our goal is to empower you with the knowledge and resources needed to do so.
                            Whether you're a concerned parent, healthcare provider, or simply curious about vaccines, we are
                            here to help. Trust in our expertise and experience to guide you towards a safer and healthier
                            future.</p>
                        <a class="btn_2 " href="{{ route('about-us') }}">learn more</a>
                        <div class="banner_item">
                            <div class="single_item">
                                <img src="{{ asset('client/img/icon/banner_1.svg') }}" alt="">
                                <h5>Safety</h5>
                            </div>
                            <div class="single_item">
                                <img src="{{ asset('client/img/icon/banner_2.svg') }}" alt="">
                                <h5>Appointment</h5>
                            </div>
                            <div class="single_item">
                                <img src="{{ asset('client/img/icon/banner_3.svg') }}" alt="">
                                <h5>Qualfied</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about us part end-->

    <!-- feature_part start-->
    <section class="feature_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>Our services</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3 col-sm-12">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="phone icon"></i></span>
                            <h4>Consultations</h4>
                            <p>Our website offers consultations with vaccine experts to provide personalized advice and
                                guidance on vaccination. We help address concerns and provide information to help
                                individuals make informed decisions about their health.</p>
                        </div>
                    </div>
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="calendar alternate outline icon"></i></span>
                            <h4>Scheduling</h4>
                            <p>Our website offers a convenient scheduling system to help you book appointments for
                                vaccinations with healthcare providers in your area.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="single_feature_img">
                        <img src="{{ asset('client/img/service.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="user md icon"></i></span>
                            <h4>Health monitoring</h4>
                            <p>We offer information and tools to help you monitor your health after vaccination, including
                                tracking and reporting adverse reactions, and staying up-to-date on vaccine safety.</p>
                        </div>
                    </div>
                    <div class="single_feature">
                        <div class="single_feature_part">
                            <span class="single_feature_icon"><i class="syringe icon"></i></span>
                            <h4>Vaccine Storage</h4>
                            <p>Our website provides guidance on proper vaccine storage to ensure their effectiveness and
                                safety. We offer resources and tips for healthcare providers and individuals managing
                                vaccine storage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature_part start-->

    <!-- our depertment part start-->
    <section class="our_depertment section_padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-12">
                    <div class="depertment_content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <h2>Vaccines</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><i class="heartbeat icon"></i></span>
                                            <h4>Live attenuated vaccines</h4>
                                            <p>Live attenuated vaccines contain weakened forms of the virus that do not
                                                cause disease; nonetheless, it still stimulate an immune response.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><i class="heartbeat icon"></i></span>
                                            <h4> Killed vaccines</h4>
                                            <p>Killed vaccines are made from viruses that have been inactivated, so they
                                                cannot cause disease but can still trigger an immune response.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><i class="heartbeat icon"></i></span>
                                            <h4>Conjugate vaccines</h4>
                                            <p>Conjugate vaccines link a weak antigen to a strong antigen to enhance the
                                                immune response and provide protection against certain bacterial diseases.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="single_our_depertment">
                                            <span class="our_depertment_icon"><i class="heartbeat icon"></i></span>
                                            <h4>mRNA vaccines</h4>
                                            <p>mRNA vaccines use a small piece of genetic material to instruct cells to
                                                produce a protein that triggers an immune response against a virus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our depertment part end-->

    <!--::doctor_part start::-->
    <section class="doctor_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2> Experienced Doctors</h2>
                        <p>Face replenish sea good winged bearing years air divide was Have night male also</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($doctorList as $doctor)
                    <div class="col-sm-6 col-lg-3">
                        <div class="single_blog_item">
                            <div class="single_blog_img">
                                @php
                                    $imageLink = is_null($doctor->image_url) || !file_exists('images/admin/doctor/' . $doctor->image_url) ? 'default-image.jpg' : $doctor->image_url;
                                @endphp
                                <img class="ui image" src="{{ asset('images/admin/doctor/' . $imageLink) }}"
                                    alt="{{ $doctor->slug }}">
                                <div class="social_icon">
                                    <ul>
                                        <li><a href="https://www.facebook.com"> <i class="ti-facebook"></i> </a></li>
                                        <li><a href="https://www.facebook.com"> <i class="ti-twitter-alt"></i> </a></li>
                                        <li><a href="https://www.facebook.com"> <i class="ti-instagram"></i> </a></li>
                                        <li><a href="https://www.facebook.com"> <i class="ti-skype"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single_text">
                                <div class="single_blog_text">
                                    <a href="{{ route('client.doctor.show', ['slug' => $doctor->slug]) }}">
                                        <h3>{{ $doctor->name }}</h3>
                                    </a>
                                    <p>{{ $doctor->short_information }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Doctor
                @endforelse
            </div>
        </div>
    </section>
    <!--::doctor_part end::-->

    <!--::regervation_part start::-->
    <section class="regervation_part section_padding">
        <div class="container">
            <div class="row align-items-center regervation_content">
                <div class="col-lg-7">
                    <div class="regervation_part_iner">
                        <form action="{{ route('client.contact.store') }}" role="form" method="POST">
                            <h2>Make a Contact</h2>
                            @csrf
                            <div class="mb-3 mt-3">
                                <label style="color: white"><i class="user icon"></i>Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>
                            @error('name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label style="color: white"><i class="envelope icon"></i>Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label style="color: white"><i class="phone icon"></i>Phone:</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter phone"
                                    name="phone">
                            </div>
                            @error('phone')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mb-3 mt-3">
                                <label style="color: white"><i class="pencil alternate icon"></i>Content:</label>
                                <input type="text" class="form-control" id="content" placeholder="Enter content"
                                    name="content">
                            </div>
                            @error('content')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn_2 btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="reservation_img">
                        <img src="{{ asset('client/img/reservation.png') }}" alt=""
                            class="reservation_img_iner">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::regervation_part end::-->

    <!--::blog_part start::-->
    <section class="blog_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section_tittle text-center">
                        <h2>Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($blogList as $blog)
                    <div class="col-sm-6">
                        <div class="single-home-blog">
                            <div class="card" >
                                @php
                                    $imageLink = is_null($blog->image_url) || !file_exists('images/admin/blog/' . $blog->image_url) ? 'default-image.jpg' : $blog->image_url;
                                @endphp
                                <img class="ui image" src="{{ asset('images/admin/blog/' . $imageLink) }}"
                                    alt="{{ $blog->slug }}" height="400px">
                                <div class="card-body">
                                    <a href="{{ route('client.blog.show', ['slug' => $blog->slug]) }}">
                                        <h5 class="card-title">{{ $blog->name }}</h5>
                                    </a>
                                    <ul>
                                        <li> <span class="ti-bookmark"></span>{{ $blog->short_description }}</li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Blog
                @endforelse
            </div>
        </div>
    </section>
    <!--::blog_part end::-->
@endsection
