@extends('admin.layouts.master-without-nav')

@section('title')
    @lang('translation.Register')
@endsection

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')

    <body class="auth-body-bg">
    @endsection

    @section('content')

        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">

                    <div class="col-xl-9">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="index" class="d-block auth-logo">
                                            <img src="{{asset('assets/images').DIRECTORY_SEPARATOR.config('constants.LOGO_FILE_NAME')}}" alt="" height="18"
                                                class="auth-logo-dark">
                                            <img src="{{asset('assets/images').DIRECTORY_SEPARATOR.config('constants.LOGO_FILE_NAME')}}" alt="" height="18"
                                                class="auth-logo-light">
                                        </a>
                                    </div>
                                    <div class="my-auto">

                                        <div>
                                            <h5 class="text-primary">Register account</h5>
                                            <p class="text-muted">Get your free {{config('constants.APP_NAME')}} account now.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" class="form-horizontal" action="{{ route('register') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                                    value="{{ old('email') }}" name="email" placeholder="Enter email" autofocus required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" id="username" name="name" autofocus required
                                                        placeholder="Enter username">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                                        placeholder="Enter password" autofocus required>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword"
                                                    name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mt-4 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light"
                                                        type="submit">Register</button>
                                                </div>

{{--                                                <div class="mt-4 text-center">--}}
{{--                                                    <h5 class="font-size-14 mb-3">Sign up using</h5>--}}

{{--                                                    <ul class="list-inline">--}}
{{--                                                        <li class="list-inline-item">--}}
{{--                                                            <a href="#"--}}
{{--                                                                class="social-list-item bg-primary text-white border-primary">--}}
{{--                                                                <i class="mdi mdi-facebook"></i>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-inline-item">--}}
{{--                                                            <a href="#"--}}
{{--                                                                class="social-list-item bg-info text-white border-info">--}}
{{--                                                                <i class="mdi mdi-twitter"></i>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-inline-item">--}}
{{--                                                            <a href="#"--}}
{{--                                                                class="social-list-item bg-danger text-white border-danger">--}}
{{--                                                                <i class="mdi mdi-google"></i>--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">By registering you agree to the {{config('constants.APP_NAME')}} <a href="#"
                                                            class="text-primary">Terms of Use</a></p>
                                                </div>
                                            </form>

                                            <div class="mt-3 text-center">
                                                <p>Already have an account ? <a href="{{ url('login') }}"
                                                        class="fw-medium text-primary"> Login</a> </p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-3 text-center">
                                        <p class="mb-0">© <script>
                                                document.write(new Date().getFullYear())

                                            </script> {{config('constants.APP_NAME')}}. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                            {{config('constants.DEVELOPED_BY')}}</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

    @endsection
    @section('script')
        <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <!-- owl.carousel js -->
        <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
        <!-- auth-2-carousel init -->
        <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script>
    @endsection
