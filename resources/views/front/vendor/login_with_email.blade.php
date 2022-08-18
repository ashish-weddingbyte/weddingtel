@extends('front.layouts.main_layout')

@section('title', 'Login')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Login Vendor</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Login Vendor</li>
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

<main id="body-content">

    <!-- login Style Main Start -->

    <section class="wide-tb-60">
        <div class="container">
            <div class="row login-section">
                <div class="col-lg-5  p-0" id="login-image">
                    <img src="{{ asset('front/images/bg_vendor_login.jpg') }}" class="" alt="">                    
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="p-4">
                        <?php 
                            $from = Request::segment(2);
                        ?>
                        
                        <div class="section-title text-right">
                            <a href="{{ url('/vendor-login/o') }}">Login With OTP <i class="fa fa-mobile"></i></a>
                        </div>

                        
                        <div class="section-title my-4 text-center">
                            @if(Session::has('message'))
                                <div class="alert {{session('class')}}">
                                    <span>{{session('message')}}</sapn>
                                </div>
                            @endif
                            <h3>Log in to your Vendor account</h3>
                            <p>Not a member yet? <a href="{{url('/vendor-register') }}">Join now</a></p>                       
                        </div> 
                        
                        <div class="login-form mb-4">

                            <form class="my-5"  action="{{ url('/vendor-login') }}" method="post"  id="login-form-e">
                                @csrf
                                
                                <div class="email-section">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email ID" type="email" name="email" id="email" value="{{ old('email') }}" >
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="password-eye">
                                            <input class="form-control" placeholder="Password" type="password" name="password" id="password" value="{{ old('password') }}">
                                            <span data-toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <input type="hidden" name="login-type" id="login-type" value="{{ $from }}">
                                    
                                    <button type="submit" class="btn btn-default btn-block">Login</button>
                                </div>
                            </form>
                        </div>

                        <div class=" section-title text-center">
                            <a href="{{ url('/vendor-forget-password') }}">Forgot your password?</a>
                        </div>
                        <hr>

                        <div class="mt-4 text-center">
                            <h3>Are you a Bride/Groom</h3>
                            <a href="{{ url('/login') }}" class="btn btn-primary btn-rounded ">User Login</a>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Style Main End -->

</main>

@endsection
