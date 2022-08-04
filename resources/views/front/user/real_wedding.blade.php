@extends('front.layouts.user_layout')

@section('title', 'Real Wedding')

@section('main-container')

    <div class="main-contaner">
        <div class="container">
            <!-- Page Heading -->
            <div class="section-title">
                <h2>Real Wedding</h2>
            </div>
            <!-- Page Heading -->
            <form action="{{ url('tools/real-wedding/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-shadow">
                    <div class="card-shadow-body">                            
                        <div class="row">
                            <div class="col-md-6 border-right no-mobile">
                                <div class="d-flex">
                                    <div class="mr-4">
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <h3 class="mb-4">My Info</h3>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="name" value="{{ $user->name }}"  placeholder="Name">
                                        </div>

                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="mr-4">
                                        <div class="form-group">
                                            <div class="custom-file-wrap">
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <h3 class="mb-4">Partner Info</h3>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="partner_name" value="{{ $details->partner_name }}" placeholder="Partner Name">
                                        </div>

                                    </div>
                                </div>
                                
                            </div>    
                        </div>                                                  
                    </div>                                        
                </div>

                <div class="card-shadow">
                    <div class="card-shadow-header p-0 d-flex align-items-center">
                        <span class="budget-head-icon"> <i class="weddingdir_location_heart"></i></span>
                        <span class="head-simple">Wedding Info</span>                                
                    </div>
                    <div class="card-shadow-body p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" placeholder="Wedding Date" value="{{ date('m/d/Y', strtotime($details->event) ) }}" name="event" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="theme-combo form-control" name="setting">
                                        <option>Select Wedding Setting</option>
                                        <option value="indoor">Indoor</option>
                                        <option value="outdoor">Outdoor</option>
                                        <option value="destination">Destination</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="theme-combo form-control" name="season">
                                        <option>Select Wedding Season</option>
                                        <option value="fall">Fall</option>
                                        <option value="spring">Spring</option>
                                        <option value="summer">Summer</option>
                                        <option value="winter">Winter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Wedding Theme" name="theme" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Wedding Tags">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="theme-combo form-control" name="community">
                                        <option>Select Community</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="muslims">Muslims</option>
                                        <option value="christians">Christians</option>
                                        <option value="sikhs">Sikhs</option>
                                        <option value="jains">Jains</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="city" id="city" class="form-control" value="{{ $details->city }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-shadow">
                    <div class="card-shadow-header p-0 d-flex align-items-center">
                        <span class="budget-head-icon"> <i class="weddingdir_heart_double_face"></i></span>
                        <span class="head-simple">Set Featured Images</span>                                
                    </div>
                    <div class="card-shadow-body p-0">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-6">
                                <div class="custom-file-featured" style="background: url({{ asset('front/images/dashboard/featured_img.jpg') }}) no-repeat; background-size: cover;">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="py-4">
                                    <div class="custom-file-wrap">
                                        <div class="custom-file-holder">
                                            <i class="fa fa-picture-o"></i>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="feature_image" aria-describedby="feature_image">
                                                <label class="custom-file-label" for="feature_image"><i class="fa fa-pencil"></i></label>
                                            </div>
                                        </div>
                                        <div class="custom-file-text">
                                            <div class="head">Upload Featured Image</div>
                                            <div>Files must be less than <strong>4mb</strong>, allowed files types are <strong>png/jpg</strong>.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-shadow">
                    <div class="card-shadow-header p-0">
                        <div class="d-flex align-items-center row">
                            <div class="col-md-5">
                                <div class="d-flex align-items-center">
                                    <span class="budget-head-icon"> <i class="weddingdir_dove"></i></span>
                                    <span class="head-simple">Upload Realwedding Gallery</span>  
                                </div>                                        
                            </div>
                                
                            <div class="col-md-7 pr-4">
                                
                                <div class="d-flex align-items-center justify-content-md-end px-3 ml-auto my-3 my-md-0">
                                    <span class="mr-3 text-muted"><small>Maximum 16 images can be uploaded</small></span>
                                    <div class="custom-file button-style">
                                        <input type="file" class="custom-file-input" id="inputGroupFile019" aria-describedby="inputGroupFile019">
                                        <label class="custom-file-label text-nowrap" for="inputGroupFile019"><i class="fa fa-plus"></i> Browse Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                    
                    </div>
                    <div class="card-shadow-body p-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dash-categories selected" style="background: url({{ asset('front/images/dashboard/dash_category.jpg') }} ) no-repeat; background-size: cover;">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </div>
                                <div class="gallery-info">
                                    <span>Event</span>
                                    Wedding
                                </div>                                            
                            </div>
                            <div class="col-md-3">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="gallery-info">
                                    <span>...</span>
                                    &nbsp;
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="gallery-info">
                                    <span>...</span>
                                    &nbsp;
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="dash-categories">
                                    <div class="edit">
                                        <a href="javascript:"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="head">
                                        <i class="fa fa-picture-o"></i>
                                    </div>
                                </div>
                                <div class="gallery-info">
                                    <span>...</span>
                                    &nbsp;
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-shadow">
                    <div class="card-shadow-header p-0">
                        <div class="d-flex align-items-center">
                            <span class="budget-head-icon"> <i class="weddingdir_wine"></i></span>
                            <span class="head-simple">Write your story here</span>  
                        </div>
                                                    
                    </div>
                    <div class="card-shadow-body p-3">
                        <textarea name="note" id="summernote" cols="5" rows="2"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary btn-rounded" name="submit" value="Update Real-Wedding">
                </div>
            </form>
            
        </div>
    </div>

@endsection

