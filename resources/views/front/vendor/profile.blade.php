@extends('front.layouts.user_layout')

@section('title', 'My Profile')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>My Profile</h2>
            <div class="mt-3">
                @if(Session::has('message'))
                    <div class="alert {{session('class')}}">
                        <span>{{session('message')}}</sapn>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div> 
        </div>
        <!-- Page Heading -->

        <div class="row">
            <!-- Profile Tabbing Start -->
            <div class="col-12 col-lg-3">
                <div class="nav flex-column nav-pills theme-tabbing-vertical" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-general" role="tab"
                        aria-controls="v-pills-general" aria-selected="true">Profile</a>
                    <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab"
                        aria-controls="v-pills-vendor" aria-selected="false">Business Profile</a>
                    <a class="nav-link" id="v-pills-groom-tab" data-toggle="pill" href="#v-pills-groom" role="tab"
                        aria-controls="v-pills-groom" aria-selected="false">Password Change
                    </a>
                    <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab"
                        aria-controls="v-pills-pricing" aria-selected="false">Social Media</a>
                </div>
            </div>
            <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="card-shadow">
                            <div class="card-shadow-header">
                                <div class="head-simple">
                                    Profile
                                </div>                                           
                            </div>

                            <div class="card-shadow-body">
                                <form action="{{ url('vendor/profile/update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-file-wrap">
                                                    <div class="custom-file-holder">
                                                        @if($details->profile_image)
                                                            <div class="avatar-wrap">
                                                                <img src="{{ asset('storage/upload/vendor/profile/'.$details->profile_image) }}" alt="">
                                                            </div>
                                                        @else
                                                            <i class="fa fa-picture-o"></i>
                                                        @endif
                                                        
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="profile" name="profile" aria-describedby="profile">
                                                            <label class="custom-file-label" for="profile"><i class="fa fa-pencil"></i></label>
                                                        </div>
                                                    </div>
                                                    <div class="custom-file-text">
                                                        <div class="head">Upload Profile Image</div>
                                                        <div>Files must be less than <strong>512KB or (250*250)</strong>, allowed files types are <strong>png/jpg/jpeg</strong>.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="name" value="{{ $user->name }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="email" value="{{ $user->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="mobile" value="{{ $user->mobile }}" disabled>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="city" value="{{ $details->city }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline form-dark">
                                                    <input type="radio" id="male" name="gender" value="male" {{ ($details->gender == 'male')?'checked':'' }} class="custom-control-input">
                                                    <label class="custom-control-label" for="male">Male</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline form-dark">
                                                    <input type="radio" value="female" id="female" {{ ($details->gender == 'female')?'checked':'' }}  name="gender" class="custom-control-input" >
                                                    <label class="custom-control-label" for="female">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <input type="submit" name="submit" class="btn btn-primary btn-rounded" value="Update Profile">
                                        </div>
                                    </div>
                                </form>                                            
                            </div>                                        
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                        <div class="card-shadow">
                            <div class="card-shadow-header">
                                <div class="head-simple">
                                    Business Profile
                                </div>                                            
                            </div>

                            <form>
                                <div class="todo-subhead">
                                    <h3>Profile Image</h3>
                                </div>
                                <div class="form-group px-3">
                                    <div class="custom-file-wrap">
                                        <div class="custom-file-holder">
                                            <i class="fa fa-picture-o"></i>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile011" aria-describedby="inputGroupFile011">
                                                <label class="custom-file-label" for="inputGroupFile011"><i class="fa fa-pencil"></i></label>
                                            </div>
                                        </div>
                                        <div class="custom-file-text">
                                            <div class="head">Upload Profile Image</div>
                                            <div>Files must be less than <strong>4mb</strong>, allowed files types are <strong>png/jpg</strong>.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Brand Image</h3>
                                </div>
                                <div class="form-group px-3">
                                    <div class="custom-file-wrap">
                                        <div class="custom-file-holder">
                                            <i class="fa fa-picture-o"></i>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile012" aria-describedby="inputGroupFile012">
                                                <label class="custom-file-label" for="inputGroupFile012"><i class="fa fa-pencil"></i></label>
                                            </div>
                                        </div>
                                        <div class="custom-file-text">
                                            <div class="head">Upload Profile Image</div>
                                            <div>Files must be less than <strong>4mb</strong>, allowed files types are <strong>png/jpg</strong>.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>About Business</h3>
                                </div>

                                <div class="px-3 pt-0">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="Business_name" placeholder="Business name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="Busines_Website" placeholder="Busines Website">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="Business_Video" placeholder="Business Video">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div id="summernote"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="Business_address" placeholder="Business address">
                                            </div>
                                        </div>  
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="theme-combo" name="state" style="width: 100%;">
                                                    <option>Select City</option>
                                                    <option>City 1</option>
                                                    <option>City 2</option>
                                                    <option>City 3</option>
                                                    <option>City 4</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="theme-combo" name="state" style="width: 100%;">
                                                    <option>Select State</option>
                                                    <option>State 1</option>
                                                    <option>State 2</option>
                                                    <option>State 3</option>
                                                    <option>State 4</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="theme-combo" name="state" style="width: 100%;">
                                                    <option>Select Country</option>
                                                    <option>Country 1</option>
                                                    <option>Country 2</option>
                                                    <option>Country 3</option>
                                                    <option>Country 4</option>
                                                </select>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Business Gallery</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dash-categories selected" style="background: url(assets/images/dashboard/dash_category.jpg) no-repeat; background-size: cover;">
                                                <div class="edit">
                                                    <a href="javascript:"><i class="fa fa-pencil"></i></a>
                                                </div>
                                            </div>                                         
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dash-categories">
                                                <div class="edit">
                                                    <a href="javascript:"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="head">
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dash-categories">
                                                <div class="edit">
                                                    <a href="javascript:"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="head">
                                                    <i class="fa fa-picture-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-3">
                                        <div class="custom-file button-style">
                                            <input type="file" class="custom-file-input" id="inputGroupFile013" aria-describedby="inputGroupFile013">
                                            <label class="custom-file-label" for="inputGroupFile013"><i class="fa fa-plus"></i> Browse Image</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Location Map</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="latitude" placeholder="Latitude">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="longitude" placeholder="Longitude">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="map-wrap">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary btn-rounded mb-4">Update Business Profile</button>        
                                </div>

                                                                    
                            </form>                                     
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-groom" role="tabpanel" aria-labelledby="v-pills-groom-tab">
                        <div class="card-shadow">
                            <div class="card-shadow-header">
                                <div class="head-simple">
                                    Password Change
                                </div>                                            
                            </div>
                            <div class="card-shadow-body">
                                <form action="{{ url('vendor/profile/change-password') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="password-eye">
                                                    <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Enter Old Password" value="{{ old('old_password') }}">
                                                    <span data-toggle="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    @error('old_password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="password-eye">
                                                    <input id="new_password" type="password" class="form-control" name="new_password" placeholder="Enter New Password" value="{{ old('new_password') }}">
                                                    <span data-toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    @error('new_password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="password-eye">
                                                    <input id="confirm_pasword" type="password" class="form-control" name="confirm_pasword" placeholder="Confirm Password" value="{{ old('confirm_pasword') }}">
                                                    <span data-toggle="#confirm_pasword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    @error('confirm_pasword')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary btn-rounded" name="submit" value="Change Password">
                                        </div>
                                                
                                    </div>
                                </form>                                           
                            </div> 
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab">
                        <div class="card-shadow">
                            <div class="card-shadow-header">
                                <div class="head-simple">
                                    Social Media
                                </div>                                            
                            </div>
                            <div class="card-shadow-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="Facebook" placeholder="Facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="Twitter" placeholder="Twitter">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="Instagram" placeholder="Instagram">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="Youtube" placeholder="Youtube">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-rounded">Update Social Profile</button>
                                        </div>
                                                
                                    </div>
                                </form>                                            
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Tabbing End -->
        </div>
    </div>
</div>

@endsection