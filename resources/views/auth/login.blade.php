<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            <div  style="display: flex; justify-content: space-between;">
                <div style="display: block">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    <div>
                        <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</a>
                    </div>
                </div>
                <x-primary-button class="ml-3" >
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </div>
            {{-- <hr style="margin-top: 5%"> --}}
            <div style=" display: block; margin: 0 auto" class="mt-4">
                {{-- <div style="display: flex; justify-content: center;  align-items: center; margin-top: 2%; border:1px solid #DCDCDC; padding: 2%" >
                    <a href="{{ route('facebook.redirect') }}" ><i style=" width:25px; height: 25px; border-radius: 50%; background-color:#E9EBEE;" class="facebook f icon"></i>Login by Facebook</a><br>
                </div> --}}
                <div style="display: flex; justify-content: center;  align-items: center; margin-top: 2%; border:1px solid #DCDCDC; padding: 2%" >
                    <a href="{{ route('google.redirect') }}" ><i style=" width:25px; height: 25px; border-radius: 50%; background-color:#E9EBEE;" class="google icon"></i>Login by Google</a>
                </div>
            </div>
    </form>
</x-guest-layout>
