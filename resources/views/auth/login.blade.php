@extends('layouts.main')

@section('content')
@include('components.toaster')
<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/login" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                        <style type="text/css">
                          .st0{fill:#5F61E6;}
                          .st1{fill:#FFFFFF;}
                        </style>
                        <g>
                          <ellipse transform="matrix(0.1639 -0.9865 0.9865 0.1639 -3.7586 45.5656)" class="st0" cx="25" cy="25" rx="24.8" ry="24.8"/>
                          <g>
                            <path class="st1" d="M9.2,23c-0.4,0-0.8-0.1-1.1-0.4c-0.8-0.6-0.9-1.7-0.3-2.5c0.4-0.5,2.1-2.3,4.8-4.1c3.5-2.3,7.3-3.7,11.1-3.9
                              c6.4-0.4,12.6,2.2,18.4,7.8c0.7,0.7,0.7,1.8,0,2.5c-0.7,0.7-1.8,0.7-2.5,0c-5-4.8-10.2-7.1-15.5-6.8c-4,0.2-7.3,1.9-9.4,3.3
                              c-2.3,1.5-3.8,3.1-4.1,3.4C10.3,22.8,9.7,23,9.2,23z M14.7,26.9c0.4-0.5,4.2-4.6,9.6-4.9c3.7-0.2,7.4,1.5,11.1,5
                              c0.7,0.7,1.9,0.7,2.5-0.1c0.7-0.7,0.7-1.9-0.1-2.5c-4.4-4.2-9-6.2-13.7-6c-6.8,0.3-11.3,5.1-12.2,6.1c-0.7,0.7-0.6,1.9,0.2,2.5
                              c0.3,0.3,0.8,0.4,1.2,0.4C13.9,27.5,14.4,27.3,14.7,26.9z M19,31.5c0.3-0.6,2.4-2.7,5.2-3c2.4-0.3,4.7,0.9,7,3.3
                              c0.7,0.7,1.8,0.8,2.5,0.1c0.7-0.7,0.8-1.8,0.1-2.5c-3.9-4.2-7.6-4.7-10-4.4c-4.1,0.4-7.1,3.4-7.9,4.8c-0.5,0.9-0.2,2,0.6,2.5
                              c0.3,0.2,0.6,0.3,0.9,0.3C18,32.3,18.6,32,19,31.5z M25,31.9c-1.9,0-3.4,1.5-3.4,3.4c0,1.9,1.5,3.4,3.4,3.4c1.9,0,3.4-1.5,3.4-3.4
                              C28.5,33.5,27,31.9,25,31.9z"/>
                          </g>
                        </g>
                        </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">NFC Nexus</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to NFC Nexus! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-3" method="POST">
                <div class="mb-3 form-group">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email or username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle form-group">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="/forgot-password">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary w-100" type="submit" id="loginButton">
                        <span id="loginSpinner" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" style="display: none;"></span>
                        Sign in
                    </button>
                    <span id="message"></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection

{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
