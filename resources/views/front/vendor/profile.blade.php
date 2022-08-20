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
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="address" placeholder="Address" value="{{ $details->address }}" >
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

                            <form action="{{ url('vendor/profile/business') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="todo-subhead">
                                    <h3>Featured Image</h3>
                                </div>
                                <div class="form-group px-3">
                                    <div class="custom-file-wrap">
                                        <div class="custom-file-holder">
                                            @if($details->featured_image)
                                                <div class="avatar-wrap">
                                                    <img src="{{ asset('storage/upload/vendor/business/'.$details->featured_image) }}" alt="">
                                                </div>
                                            @else
                                                <i class="fa fa-picture-o"></i>
                                            @endif
                                            
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="featured_image" name="featured_image" aria-describedby="featured_image">
                                                <label class="custom-file-label" for="featured_image"><i class="fa fa-pencil"></i></label>
                                            </div>
                                        </div>
                                        <div class="custom-file-text">
                                            <div class="head">Upload Featured Image</div>
                                            <div>Files must be less than <strong>1024KB or (600*450)</strong>, allowed files types are <strong>png/jpg/jpeg</strong>.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Brand Name</h3>
                                </div>
                                <div class="form-group px-3">
                                    <input type="text" class="form-control" id="brandname" name="brandname" placeholder="Brand name" value="{{ $details->brandname }}">
                                </div>

                                <div class="todo-subhead">
                                    <h3>Description</h3>
                                </div>

                                <div class="px-3 pt-0">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="description" id="description" cols="5" rows="10" class="summernote">{{ $details->description }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Services Offered</h3>
                                </div>

                                <div class="px-3 pt-0">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="service_offered" id="service_offered" cols="5" rows="10" class="summernote">{{ $details->service_offered }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Business Details</h3>
                                </div>

                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="business_details" id="business_details" cols="5" rows="10" class="summernote">{{ $details->business_offered }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="todo-subhead">
                                    <h3>Travel to client Venue</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="travelable" id="travelable" class="form-control">
                                                    <option value="NA">Select One</option>
                                                    <option value="1" {{ ($details->is_travelable==1)?'selected':'' }}  >Yes</option>
                                                    <option value="0" {{ ($details->is_travelable==0)?'selected':'' }} >No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="todo-subhead">
                                    <h3>Cancel Policy</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="cancel_policy" id="cancel_policy" class="form-control" placeholder="No Refund">
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="todo-subhead">
                                    <h3>Youtube Link</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="youtube" id="youtube" class="form-control" placeholder="Youtube" value="{{ $details->youtube }}">
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="todo-subhead">
                                    <h3>Advance Payment</h3>
                                </div>
                                <div class="px-3 pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="advance_payment" id="advance_payment" class="form-control">
                                                    <option value="0">Select One</option>
                                                    <option value="10" {{ ($details->advance_payment==10)?'selected':'' }} >10%</option>
                                                    <option value="20" {{ ($details->advance_payment==20)?'selected':'' }} >20%</option>
                                                    <option value="30" {{ ($details->advance_payment==30)?'selected':'' }} >30%</option>
                                                    <option value="40" {{ ($details->advance_payment==40)?'selected':'' }} >40%</option>
                                                    <option value="50" {{ ($details->advance_payment==50)?'selected':'' }} >50%</option>
                                                    <option value="60" {{ ($details->advance_payment==60)?'selected':'' }} >60%</option>
                                                    <option value="70" {{ ($details->advance_payment==70)?'selected':'' }} >70%</option>
                                                    <option value="80" {{ ($details->advance_payment==80)?'selected':'' }} >80%</option>
                                                    <option value="90" {{ ($details->advance_payment==90)?'selected':'' }} >90%</option>
                                                    <option value="100" {{ ($details->advance_payment==100)?'selected':'' }} >100%</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <input type="submit" class="btn btn-primary btn-rounded" name="submit" value="Update Business Profile">
                                        </div>
                                    </div>        
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
                                <form method="post" action="{{ url('/vendor/profile/social') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="facebook" placeholder="Facebook" value="{{ $social->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="twitter" placeholder="Twitter" value="{{ $social->twitter }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="instagram" placeholder="Instagram" value="{{ $social->instagram }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="youtube" placeholder="Youtube" value="{{ $social->youtube }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-dark" name="website" placeholder="Website" value="{{ $social->website }}">
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12">
                                            <input type="submit" name="submit" class="btn btn-primary btn-rounded" value="Update Social Links">
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