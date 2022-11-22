@extends('front.layouts.main_layout')

@section('title', 'Login')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Reset Password</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
                    <img src="{{ asset('front/images/bg_vendor_login.jpeg') }}" class="" alt="">                    
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="p-4">
                        <?php 
                            $from = Request::segment(2);
                            $id = Request::segment(3);
                        ?>

                        <div class="section-title my-4 text-center">
                            @if(Session::has('message'))
                                <div class="alert {{session('class')}}">
                                    <span>{{session('message')}}</sapn>
                                </div>
                            @endif
                            <h3>Reset Password</h3>                      
                        </div> 
                        
                        <div class="login-form mb-4">

                            <form class="my-5"  action="{{ url('vendor-reset-password') }}" method="post"  id="login-form-e">
                                @csrf
                                
                                <div class="email-section">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" type="password" name="password" id="password" >
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password" >
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input type="hidden" name="from" value="{{ $from }}">
                                    <input type="hidden" name="user_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-default btn-block btn-rounded">Change Passowrd</button>
                                </div>
                            </form>
                        </div>

                        <div class="section-title my-4 text-center">
                            <h3>Log in to your account</h3>
                            <p><a href="{{url('/vendor-login') }}">Login</a></p>                       
                        </div> 
                        <!-- <hr>

                        <div class="mt-4 text-center">
                            <h3>Are you a Bride/Groom</h3>
                            <a href="{{ url('/login') }}" class="btn btn-success btn-rounded ">User Login</a>                     
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Style Main End -->

</main>

@endsection
