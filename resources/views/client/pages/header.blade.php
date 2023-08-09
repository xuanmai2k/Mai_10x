<!--::header part start::-->
<header class="main_menu ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('client.home.list') }}"> <img src="{{ asset('client/img/logo.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item justify-content-center"
                        id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('client.home.list') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('appointment.index') }}">{{ __('Appointment') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about-us') }}">{{ __('About us') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.vaccine.list') }}">{{ __('Vaccine') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Team') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('client.doctor.list') }}">{{ __('Doctor') }}</a>
                                    <a class="dropdown-item" href="{{ route('client.nurse.list') }}">{{ __('Nurse') }}</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.service.list') }}">{{ __('Service') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.blog.list') }}">{{ __('Blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown"
                                    data-toggle="dropdown" aria-haspopup="true">
                                    <i class="globe icon"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('language.index',['locale'=>'en'])}}"><i class="us flag"> {{ __('English') }}</i></a>
                                    <a class="dropdown-item" href="{{route('language.index',['locale'=>'vi'])}}"><i class="vn flag"> {{ __('Vietnamese') }}</i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if (auth()->check())
                    <div class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            @php
                                $imageLink = is_null(auth()->user()->image_url) || !file_exists('images/client/'.auth()->user()->image_url) ? 'default-image.jpg' : auth()->user()->image_url;
                            @endphp
                            <img src="{{ asset('images/client/'.$imageLink) }}" alt="{{ auth()->user()->name }}" class="ui avatar image" ><span>{{ auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('account.index') }}">
                                <i style="margin-left: 15px" class="ti-user text-primary"></i> {{ __('Account') }}
                            </a>
                            <a>
                                <form  class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <i class="ti-power-off text-primary"></i> {{ __('Logout') }}
                                    </x-responsive-nav-link>
                                </form>
                            </a>
                        </div>
                    </div>
                    @else
                        <a class="btn_2 d-none d-lg-block" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->
