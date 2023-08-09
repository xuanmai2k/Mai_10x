<!-- footer part start-->
<footer class="footer-area">
    <div class="footer section_padding">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-2 col-md-4 col-sm-6 single-footer-widget">
                    <a href="{{ route('client.home.list') }}" class="footer_logo"> <img src="{{ asset('client/img/logo.png') }}" alt="#">
                    </a>
                    <p>MaiVaccine is your go-to platform for finding reliable information on the latest vaccines and trusted healthcare providers.  </p>
                    <div class="social_logo">
                        <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-facebook"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100094678578978"> <i class="ti-twitter"></i> </a>
                        <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-instagram"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-skype"></i></a>
                    </div>
                </div>
                <div class="col-xl-1 col-sm-6 col-md-6 single-footer-widget">
                    <h4><i class="linkify icon"></i>Links</h4>
                    <ul>
                        <li><a href="{{ route('about-us') }}">About us</a></li>
                        <li><a href="{{ route('appointment.index') }}">Appointment</a></li>
                        <li><a href="{{ route('client.vaccine.list') }}">Vaccine</a></li>
                        <li><a href="{{ route('client.service.list') }}">Service</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 col-sm-6 col-md-6 single-footer-widget">
                    <h4><i class="info icon"></i>Information</h4>
                    <ul>
                        <li><a href="#"><i class="map marker alternate icon"></i>Address: 40 DoiCung Ward 11 District 11 </a></li>
                        <li><a href="#"><i class="phone icon"></i>Hotline: +(84)783362649</a></li>
                        <li><a href="#"><i class="envelope outline icon"></i>Email: maivaccine@gmail.com </a></li>
                        <li><a href="#"><i class="lock open icon"></i>Mon to Sat: 8am - 6pm</a></li>
                    </ul>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-6 single-footer-widget">
                    <h4><i class="facebook icon"></i>Social Network</h4>
                    <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100094938490732&amp;is_tour_completed=true" data-tabs="timeline,messages" data-width="500" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100094938490732&amp;is_tour_completed=true" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100094938490732&amp;is_tour_completed=true">MaiVaccine</a></blockquote></div>
                        {{-- share --}}
                    {{-- <div class="fb-share-button" data-href="http://127.0.0.1:8000/home" data-layout="button"
                        data-size="large"><a target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}"
                        class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="copyright_part">
        <div class="container">
            <div class="row align-items-center">
                <p class="footer-text m-0 col-lg-8 col-md-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="ti-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                    <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-facebook"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100094678578978"> <i class="ti-twitter"></i> </a>
                    <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-instagram"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100094678578978"><i class="ti-skype"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- footer part end-->
