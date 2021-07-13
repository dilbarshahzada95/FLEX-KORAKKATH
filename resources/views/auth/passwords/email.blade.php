@extends('layouts.master')

@section('content')
   <div class="container">
            <div class="row">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2 nm-st nm-st-md">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form  method="POST" action="{{ route('password.email') }}">
                        @csrf
                   
                        
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                   @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
            
                        
                        <div class="row nm-aic nm-mb-2">
                    
                            
                            <div class="col-sm-6 nm-sm-tr">
                                <button type="submit" class="btn btn-primary nm-hvr nm-btn-1">Send Password Reset Link</button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
@endsection
