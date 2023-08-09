<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="INDEX,FOLLOW">
    @yield('seo')
    <title>MaiVaccine</title>
    <link rel="icon" href="{{ asset('client/img/favicon.png') }}">
    <!--Datepicker -->
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/animate.css') }}">
    <!-- owl carousel CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}"> --}}
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/themify-icons.css') }}">
    <!-- flaticon CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('client/css/flaticon.css') }}"> --}}
    <!-- magnific popup CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('client/css/magnific-popup.css') }}"> --}}
    <!-- nice select CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('client/css/nice-select.css') }}"> --}}
    <!-- swiper CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('client/css/slick.css') }}"> --}}
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <!-- semantic -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <!-- animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>
    <!--Jquery ajax-->
    {{-- <script src="jquery-3.6.4.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <!-- datepicker -->
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}

</head>

<body>

    <!-- header part start-->
    @include('client.pages.header')
    <!-- header part end-->

    <!-- banner part start-->
    <section class="banner_part" data-spy="scroll">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-xl-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            @yield('titleIntroAndButtonBanner')
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner_img">
                        @yield('imageBanner')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    @yield('content')



    <!-- footer part start-->
    @include('client.pages.footer')
    <!-- footer part end-->

    <!-- jquery plugins here-->
    {{-- <script src="{{ asset('client/js/jquery-1.12.1.min.js') }}"></script> --}}
    <!-- popper js -->
    {{-- <script src="{{ asset('client/js/popper.min.js') }}"></script> --}}
    <!-- bootstrap js -->
    <script src="{{ asset('client/js/bootstrap.min.js') }}"></script> <!--menu = -->
    <!-- owl carousel js -->
    {{-- <script src="{{ asset('client/js/owl.carousel.min.js') }}"></script> không dùng được sweetalert2
    <script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script> --}}
    <!-- contact js -->
    {{-- <script src="{{ asset('client/js/jquery.ajaxchimp.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('client/js/jquery.form.js') }}"></script> --}}
    {{-- <script src="{{ asset('client/js/jquery.validate.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('client/js/mail-script.js') }}"></script> --}}
    {{-- <script src="{{ asset('client/js/contact.js') }}"></script> --}}
    <!-- custom js -->
    <script src="{{ asset('client/js/custom.js') }}"></script>
    <!--Facebook -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0" nonce="hxzeLZzs"></script>
    <!-- chat zalo -->
    <style>
        .zalo-chat-widget {
            left: 0;
            right: auto;
        }
    </style>
    <div class="zalo-chat-widget" data-oaid="1046031062660786985" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>

    @yield('script-pop-up')
    <!-- pop up -->
    @yield('js-custom')
    <!-- jquery ajax -->
</body>

</html>
