<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('logo/login-favicon.png') }} ">
</head>

<body>
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                {{-- <a href="/"> --}}
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <div
                    style="
                        /* make it a flex container */
                        display: flex;
                        /* align the items vertically */
                        align-items: center;
                        /* align the items horizontally */
                        justify-content: center;
    
                    ">
                    <img src="{{ asset('logo/login.png') }}"
                        style="
                            height: 50px;
                            margin-right: 10px;
                        ">
                    <span
                        style="
                            font-size: 20px; font-weight: bold
                        ">Login</span>
                </div>
            </x-slot>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="username" :value="__('Username')" />

                    <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                        required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</body>

</html>
