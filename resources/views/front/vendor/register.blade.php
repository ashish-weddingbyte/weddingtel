@extends('front.layouts.main_layout')

@section('title', 'Register')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Register Vendor</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Register Vendor</li>
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
                        <div class="section-title my-4 text-center">
                            @if(Session::has('message'))
                                <div class="alert {{session('class')}}">
                                    <span>{{session('message')}}</sapn>
                                </div>
                            @endif
                            <h3>Sign up with your email</h3>
                            <p>Already have an account? <a href="{{url('/vendor-login') }}">Login</a></p>                       
                        </div> 
                        
                        <div class="login-form mb-5">

                            <form class="my-5" method="post" action="{{ url('/vendor-register') }}" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="Full Name" type="text" name="name" id="name"  value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email ID" type="email" name="email" id="email" value="{{ old('email') }}">
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
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mobile" type="number" name="mobile" id="mobile" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <?php
                                        $categories = App\Models\Category::all();
                                    ?>
                                    <select name="category" id="category" class="form-control">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="City" type="text" name="city" id="city"  value="{{ old('city') }}">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <p>By clicking 'Sign up', I agree to WeddingByte’s Privacy Policy and Terms of Use</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-block">Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="section-title mt-5 text-center">
                            <h3>Are you a vendor?</h3>
                            <a href="{{ url('/vendor-login') }}" class="btn btn-outline-default btn-rounded ">Vendor Login</a>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Style Main End -->

</main>

@endsection