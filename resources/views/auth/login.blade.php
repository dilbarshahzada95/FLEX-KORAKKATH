@extends('layouts.master')

@section('content')
    <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2 nm-st nm-st-md">
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="nm-mb-2 nm-mb-md-2">
                            <h2>Welcome Back</h2>
                            <p>Login to your account</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputPassword">
                                <span class="d-flex nm-jcb nm-aic">
                                    Password
                                    
                                </span>
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********" >
                        </div>
                        
                        <div class="row nm-aic nm-mb-2">
                            <div class="col-sm-6 nm-mb-1 nm-mb-sm-0">
                                 @if (Route::has('password.request'))
                                <a class="nm-lu nm-ct" href="{{ route('password.request') }}">Forgot Password?</a>
                                  @endif
                            </div>
                            
                            <div class="col-sm-6 nm-sm-tr">
                                <button type="submit" class="btn btn-primary nm-hvr nm-btn-1">Log In</button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
@endsection
