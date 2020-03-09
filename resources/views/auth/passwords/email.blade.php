<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <style>
        html,body {
            height: 100%;
        }
        body{
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
        }
    </style>
    <body class="bg-gradient-light">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
                                        </div>
                                        <form class="user" method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email" class="sr-only">Endereço de Email</label>
                                                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email Address..." required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit">{{ __('Send Password Reset Link') }}</button>
                                        </form>
                                        @if(env('ALLOW_REGISTRATION', false))
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="{{ route('register') }}">Novo Registro</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
