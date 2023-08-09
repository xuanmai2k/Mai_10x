<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{ asset('admin/images/logo.png') }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('admin/images/logo_mini.png') }}"
                alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @php
                        $imageLink = is_null(auth()->user()->image_url) || !file_exists('images/client/' . auth()->user()->image_url) ? 'default-image.jpg' : auth()->user()->image_url;
                    @endphp
                    <img src="{{ asset('images/client/' . $imageLink) }}" alt="{{ auth()->user()->name }}" class="ui avatar image"><span>  {{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a>
                        <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="ti-power-off text-primary"></i> {{ __('Logout') }}
                            </x-responsive-nav-link>
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
