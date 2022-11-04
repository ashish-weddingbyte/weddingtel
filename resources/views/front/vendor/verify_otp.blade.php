@extends('front.layouts.main_layout')

@section('title', 'Verify OTP')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Verify OTP</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Verify OTP</li>
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
                <div class="col-md-12 col-lg-7 ">
                    <div class="p-4">
                        <?php 
                            $from = Request::segment(2);
                            $id = Request::segment(3);

                            $user = App\Models\User::find($id);
                        ?>
                        @if($from == 'r')
                            <div class="text-right section-title">
                                <a href="{{ url('/vendor-login/e') }}">Skip & Login With Email <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
                            </div>
                        @endif

                        <div class="section-title my-4 text-center">
                            @if(Session::has('message'))
                                <div class="alert {{session('class')}}">
                                    <span>{{session('message')}}</sapn>
                                </div>
                            @endif
                            <h3>Verify OTP</h3>
                            <p>OTP Send to @if($user->mobile) {{$user->mobile}} @endif</p>
                            <p>Change Mobile Number  <a href="{{url('/vendor-login') }}">Re-Enter</a></p>                       
                        </div> 
                        
                        <div class="login-form mb-5">

                            <form class="my-5" method="post" action="{{ url('/vendor-verify-otp') }}" id="otp-form">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter OTP" type="number" name="otp" id="otp" value="{{ old('otp') }}">
                                    @error('otp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- <div class="text-right section-title">
                                    <p id="otp_timer"></p>
                                </div> -->

                                <div class="form-group">
                                    <input type="hidden" name="from" value="{{ $from }}">
                                    <input type="hidden" name="user_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-default btn-block btn-rounded">Verify OTP</button>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="mt-4 text-center">
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