@extends('front.layouts.user_layout')

@section('title', 'Profile')

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
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">My Profile</a>
                        <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab" aria-controls="v-pills-vendor" aria-selected="false">Wedding Information</a>
                        <a class="nav-link" id="v-pills-groom-tab" data-toggle="pill" href="#v-pills-groom" role="tab" aria-controls="v-pills-groom" aria-selected="false">Password Change</a>
                        <!-- <a class="nav-link" id="v-pills-pricing-tab" data-toggle="pill" href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing" aria-selected="false">Social Media</a> -->
                    </div>
                </div>
                <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="card-shadow">
                                <div class="card-shadow-header">
                                    <div class="head-simple">
                                        My Profile
                                    </div>                                            
                                </div>

                                <div class="card-shadow-body">
                                    <form action="{{ url('tools/profile/update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="custom-file-wrap">
                                                        <div class="custom-file-holder">
                                                            @if($details->profile)
                                                                <div class="avatar-wrap">
                                                                    <img src="{{ asset('storage/upload/user/profile/'.$details->profile) }}" alt="">
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
                                                            <div>Files must be less than <strong>512 kb or (600*600)</strong>, allowed files types are <strong>png/jpg/jpeg</strong>.</div>
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
                                                    <select class="form-light-select theme-combo" name="city">
                                                        <option value='0'>Choose Location</option> 
                                                        @if($cities)   
                                                            @foreach($cities as $city)
                                                                
                                                                @if($city->id == $details->city_id)  
                                                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                                @else
                                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                                @endif

                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio custom-control-inline form-dark">
                                                        <input type="radio" id="bride" name="type" value="bride" {{ ($details->type == 'bride')?'checked':'' }} class="custom-control-input">
                                                        <label class="custom-control-label" for="bride">Bride</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio custom-control-inline form-dark">
                                                        <input type="radio" value="groom" id="groom" {{ ($details->type == 'groom')?'checked':'' }}  name="type" class="custom-control-input" >
                                                        <label class="custom-control-label" for="groom">Groom</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-dark" name="partner_name" value="{{ $details->partner_name }}" placeholder="Patner Name" >
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
                                        Wedding Information
                                    </div>                                            
                                </div>

                                <div class="card-shadow-body">
                                    <form action="{{ url('tools/profile/wedding-info') }}" method="post" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-file-wrap w-100">
                                                        <div class="custom-file-holder">
                                                            @if($details->profile)
                                                                <div class="avatar-wrap">
                                                                    <img src="{{ asset('storage/upload/user/profile/'.$details->profile) }}" alt="">
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
                                                            <div>Files must be less than <strong>1mb or (600*600)</strong>, allowed files types are <strong>png/jpg</strong>.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-file-wrap w-100">
                                                        <div class="custom-file-holder">
                                                            @if($details->partner_profile)
                                                                <div class="avatar-wrap">
                                                                    <img src="{{ asset('storage/upload/user/profile/'.$details->partner_profile) }}" alt="">
                                                                </div>
                                                            @else
                                                                <i class="fa fa-picture-o"></i>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="partner_profile"  name="partner_profile" aria-describedby="partner_profile">
                                                                <label class="custom-file-label" for="partner_profile"><i class="fa fa-pencil"></i></label>
                                                            </div>
                                                        </div>
                                                        <div class="custom-file-text">
                                                            <div class="head">Upload Partner Image</div>
                                                            <div>Files must be less than <strong>1mb or (600*600)</strong>, allowed files types are <strong>png/jpg</strong>.</div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control datepicker"  name="event"  value="{{ date('m/d/Y', strtotime($details->event) ) }}" placeholder="Select Wedding Date">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  name="wedding_address" placeholder="Wedding Address" value="{{ $details->wedding_address }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary btn-rounded" value="Update Wedding Information">
                                            </div>                                                            
                                        </div>
                                    </form>                                            
                                </div>                                        
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
                                    <form action="{{ url('tools/profile/change-password') }}" method="post">
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

