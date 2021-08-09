@extends('layouts.app')


@section('content')


<section class="main container">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-12 col-mg-6 col-lg-5">
            <div class="my-3">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <span class="bg-primary p-2 rounded d-flex justify-content-center align-items-center mr-2">
                        <i class="feather-shopping-bag text-white h4 mb-0"></i>
                    </span>
                    <span class="font-weight-bolder h4 mb-0 text-uppercase text-primary">KC Sportswear Collection</span>
                </div>
                <div class="border bg-white rounded-lg shadow-sm">
                    <div class="p-4">
                        <h2 class="text-center font-weight-normal">Create Account</h2>
                        <p class="text-center text-black-50 mb-4">
                            Already have an account?
                            <a href="{{route('login')}}">Sign in here</a>
                        </p>
                        <a href="#" class="btn btn-outline-danger btn-block">
                            <i class="feather-log-in"></i>
                            Sign in with Google
                        </a>
                        <hr class="mb-2">
                        <form action="{{route('register')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Full Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                      </div>
                                </div>

                            </div>

                            <div class="form-group mb-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                    <label class="custom-control-label text-muted" for="terms">
                                        I accept the <a href="#">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection