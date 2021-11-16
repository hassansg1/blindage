@extends('layouts.master-without-nav')

@section('title')
    @lang('translation.Login') -
@endsection

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
@endsection

@section('body')

    <body class="auth-body-bg">
    @endsection

    @section('content')

        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">

                    <div class="col-xl-12">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay">
                                    <div class="">
                                        <div class="auth-full-page-content p-md-5 p-4">
                                            <div class="w-100">

                                                <div class="d-flex flex-column h-100 loginWrapper">
                                                    <div class="mb-4 mb-md-3 text-center">
                                                        <a href="{{url('appointment_book') }}" class="auth-logo">
                                                            <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="60"
                                                                class="auth-logo-dark">
                                                        </a>
                                                    </div>
                                                    <h5 class="text-center" style="color: #010724;"><b>Welcome Back to Our Portal !</b></h5>
                                                    <div class="my-auto">

                                                       {{--  <div class="welcomeTextWrapper">
                                                            <h5 class="text-white"><b>Welcome Back !</b></h5>
                                                            <p class="text-white mb-0"><b>Sign in to our Portal.</b></p>
                                                        </div> --}}

                                                        <div class="mt-4">
                                                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Email</label>
                                                                    <input name="email" type="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        value="{{ old('email', 'admin@themesbrand.com') }}" id="username"
                                                                        placeholder="Enter Email" autocomplete="email" autofocus>
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    {{-- <div class="float-end">
                                                                        @if (Route::has('password.request'))
                                                                            <a href="{{ route('password.request') }}"
                                                                                class="text-muted">Forgot password?</a>
                                                                        @endif
                                                                    </div> --}}
                                                                    <label class="form-label">Password</label>
                                                                    <div
                                                                        class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                                                        <input type="password" name="password"
                                                                            class="form-control  @error('password') is-invalid @enderror"
                                                                            id="userpassword" value="123456" placeholder="Enter password"
                                                                            aria-label="Password" aria-describedby="password-addon">
                                                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                                                class="mdi mdi-eye-outline"></i></button>
                                                                        @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input mt-0" type="checkbox" id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="remember">
                                                                        Remember me
                                                                    </label>
                                                                </div>

                                                                <div class="mt-3 d-grid">
                                                                    <button class="btn btn-primary waves-effect waves-light"
                                                                        type="submit">Log
                                                                        In</button>
                                                                </div>

                                                                {{-- <div class="mt-4 text-center">
                                                                    <h5 class="font-size-14 mb-3">Sign in with</h5>

                                                                    <ul class="list-inline">
                                                                        <li class="list-inline-item">
                                                                            <a href="#"
                                                                                class="social-list-item bg-primary text-white border-primary">
                                                                                <i class="mdi mdi-facebook"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <a href="#"
                                                                                class="social-list-item bg-info text-white border-info">
                                                                                <i class="mdi mdi-twitter"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <a href="#"
                                                                                class="social-list-item bg-danger text-white border-danger">
                                                                                <i class="mdi mdi-google"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div> --}}
                                                            </form>
                                                            {{-- <div class="mt-5 text-center">
                                                                <p>Don't have an account ? <a href="{{ url('register') }}"
                                                                        class="fw-medium text-primary"> Signup now </a> </p>
                                                            </div> --}}
                                                        </div>
                                                    </div>

                                                    <div class="mt-4 mt-md-5 text-center">
                                                        <p class="mb-0">©{{--  <script>
                                                                document.write(new Date().getFullYear())

                                                            </script>  --}}Copyright 2021, <span class="text-black">Blindage</span>.</p>
                                                            <p>Developed By <a href="#" class="text-black">Symtaxglobal</a></p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                   
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

    @endsection
    @section('script')
        <!-- owl.carousel js -->
        <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <!-- auth-2-carousel init -->
        <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script>
    @endsection
