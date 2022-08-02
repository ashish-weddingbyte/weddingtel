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
            <form>
                <div class="card-shadow">
                    <div class="card-shadow-body">                            
                        <div class="row">
                            <div class="col-md-6 border-right no-mobile">
                                <div class="d-flex">
                                    <div class="mr-4">
                                        <div class="form-group">
                                            <div class="custom-file-wrap">
                                                <div class="custom-file-holder" style="background: url('assets/images/dashboard/real_wedding_groom.jpg') no-repeat; background-size: cover;">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFile01">
                                                        <label class="custom-file-label" for="inputGroupFile01"><i class="fa fa-pencil"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <h3 class="mb-4">Groom Info</h3>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="Groom_First_Name" placeholder="First Name">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="Groom_Last_Name" placeholder="Last Name">
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
                                                    <i class="fa fa-picture-o"></i>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile012" aria-describedby="inputGroupFile012">
                                                        <label class="custom-file-label" for="inputGroupFile012"><i class="fa fa-pencil"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <h3 class="mb-4">Bride Info</h3>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="Bride_First_Name" placeholder="First Name">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-dark" name="Bride_Last_Name" placeholder="Last Name">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" placeholder="Wedding Date" name="Wedding_Date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="theme-combo" name="state" style="width: 100%;">
                                        <option>Select Wedding Setting</option>
                                        <option>Wedding Setting 1</option>
                                        <option>Wedding Setting 2</option>
                                        <option>Wedding Setting 3</option>
                                        <option>Wedding Setting 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="theme-combo" name="state" style="width: 100%;">
                                        <option>Select Wedding Season</option>
                                        <option>Wedding Season 1</option>
                                        <option>Wedding Season 2</option>
                                        <option>Wedding Season 3</option>
                                        <option>Wedding Season 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="theme-combo" name="state" style="width: 100%;">
                                        <option>Select Wedding Categories</option>
                                        <option>Wedding Categories 1</option>
                                        <option>Wedding Categories 2</option>
                                        <option>Wedding Categories 3</option>
                                        <option>Wedding Categories 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Wedding Tag" name="Wedding_Tag">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Wedding Community" name="Wedding_Community">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="select-multiple" name="states[]" multiple="multiple" style="width: 100%;">
                                        <option>Haldi</option>
                                        <option>Mehendi</option>
                                        <option>Pre Wedding</option>
                                        <option>Wedding</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="select-multiple" name="states[]" multiple="multiple" style="width: 100%;">
                                        <option>Floral</option>
                                        <option>Pink</option>
                                        <option>Traditional</option>
                                    </select>
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
                                <div class="custom-file-featured" style="background: url(assets/images/dashboard/featured_img.jpg) no-repeat; background-size: cover;">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile015" aria-describedby="inputGroupFile015">
                                        <label class="custom-file-label" for="inputGroupFile015"><i class="fa fa-pencil"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="py-4">
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
                                <div class="dash-categories selected" style="background: url('assets/images/dashboard/dash_category.jpg') no-repeat; background-size: cover;">
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
                        <div id="summernote"></div>
                    </div>
                </div>

                <div class="card-shadow">
                    <div class="card-shadow-header p-0">
                        <div class="d-flex align-items-center row">
                            <div class="col-md-5">
                                <div class="d-flex align-items-center">
                                    <span class="budget-head-icon"> <i class="weddingdir_vendor_truck"></i></span>
                                    <span class="head-simple">Vendor Credits</span>  
                                </div>                                        
                            </div>
                                
                            <div class="col-md-7 text-md-right py-3 py-md-0">
                                
                                <button class="btn btn-default btn-sm mx-3"><i class="fa fa-plus"></i> Add New Vendor</button>
                            </div>
                        </div>
                                                    
                    </div>
                    <div class="card-shadow-body card-shadow-body p-0 vendor-input">
                        <div class="input-wraps">
                            <div class="d-flex">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Write Category">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Business Name">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="https://example.com/">
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>           
                                <div class="col-auto p-0">
                                    <span><a href="javascript:" class="action-links pt-3 mr-3"><i class="fa fa-trash"></i></a></span>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="input-wraps">
                            <div class="d-flex">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Write Category">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Business Name">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="https://example.com/">
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>           
                                <div class="col-auto p-0">
                                    <span><a href="javascript:" class="action-links pt-3 mr-3"><i class="fa fa-trash"></i></a></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="input-wraps">
                            <div class="d-flex">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Write Category">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Business Name">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="https://example.com/">
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>           
                                <div class="col-auto p-0">
                                    <span><a href="javascript:" class="action-links pt-3 mr-3"><i class="fa fa-trash"></i></a></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="input-wraps">
                            <div class="d-flex">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Write Category">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Business Name">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="https://example.com/">
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>           
                                <div class="col-auto p-0">
                                    <span><a href="javascript:" class="action-links pt-3 mr-3"><i class="fa fa-trash"></i></a></span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
  
            </form>
            
        </div>
    </div>

@endsection

