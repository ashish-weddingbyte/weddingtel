@extends('front.layouts.user_layout')

@section('title', 'Real Wedding')

@section('main-container')

    <div class="main-contaner">
        <div class="container">
            <!-- Page Heading -->
            <div class="section-title">
                <h2>Submit Your Wedding</h2>
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
            <form action="{{ url('tools/real-wedding/save') }}" method="post" enctype="multipart/form-data">    
                @csrf
                <div class="card-shadow">
                <div class="card-shadow-body">                            
                    <div class="row">
                        <div class="col-md-6 border-right no-mobile">
                            <div class="d-flex">
                                
                                <div class="w-100">
                                    <h3 class="mb-4">My Info</h3>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-dark" name="my_name" placeholder="Full Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">

                                <div class="w-100">
                                    <h3 class="mb-4">Partner Info</h3>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-dark" name="partner_name" placeholder="Full Name" value="{{ $details->partner_name }}">
                                    </div>
                                </div>
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
                                @if(!empty($realwedd->featured_image))
                                    <div class="custom-file-featured" style="background: url({{ asset('storage/upload/realwedding/profile/'.$realwedd->featured_image) }}) no-repeat; background-size: cover;">
                                        <div class="custom-file">
                                            <input type="button" class="custom-file-input" id="featured_image" data-toggle="modal" data-target="#delete_featured_image" aria-describedby="featured_image">
                                            <label class="custom-file-label" for="featured_image"><i class="fa fa-trash" aria-hidden="true"></i></label>
                                        </div>
                                    </div>
                                @else
                                    <div class="featured-img">
                                        <img src="{{ asset('front/default_image/default_featured_image.png') }}" alt="" class="img" >
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="py-4">
                                    <div class="custom-file-wrap">
                                        <div class="custom-file-holder">
                                            <i class="fa fa-picture-o"></i>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="feature_image" name="feature_image" accept=".jpg,.jpeg,.png" aria-describedby="feature_image">
                                                <label class="custom-file-label" for="feature_image"><i class="fa fa-pencil"></i></label>
                                            </div>
                                            
                                        </div>
                                        <div class="custom-file-text">
                                            <div class="head">Upload Featured Image</div>
                                            <div>Files must be less than <strong>512KB or (800*300)</strong>, allowed files types are <strong>png/jpg/jpeg</strong>.</div>
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
                                    <span class="mr-3 text-muted"><small>Maximum 6 images can be uploaded</small></span>
                                    <div class="custom-file button-style">
                                        <input type="file" class="custom-file-input" id="gallery" aria-describedby="gallery" name='gallery[]' accept=".jpg,.png,.jpeg" multiple>
                                        <label class="custom-file-label text-nowrap" for="gallery"><i class="fa fa-plus"></i> Browse Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                    
                    </div>
                    <div class="card-shadow-body p-3">
                        <div class="row">
                            @if($gallery->count() > 0)

                                @foreach($gallery as $g)

                                <div class="col-md-4">
                                    <div class="dash-categories selected" style="background: url( {{ asset('storage/upload/realwedding/gallery/'.$g->name) }} ) no-repeat; background-size: cover;">
                                        <div class="edit">
                                            <a data-toggle="modal" data-target="#delete_modal-{{ $g->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>                                         
                                </div>

                                    
                                @endforeach
                                
                            @else
                                <div class="col-md-12 my-5">
                                    <div class="text-center mb-3">
                                        <div class="custom-file button-style">
                                            <h5>No Gallery Images Found!</h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                            <h4>Image Preview</h4>
                                <div class="images-preview-div"> </div>
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
                    @if(!empty( $realwedd->description) )
                    <div class="card-shadow-body p-3">
                        <textarea name="description" class="summernote" cols="5" rows="2">{{ $realwedd->description }}</textarea>
                    </div>
                    @else
                    <div class="card-shadow-body p-3">
                        <textarea name="description" class="summernote" cols="5" rows="2"></textarea>
                    </div>
                    @endif
                </div>

                <div class="col-md-12">

                    @if(!empty($realwedd))
                        <input type="hidden" name="realwedd_id" value="{{ $realwedd->id }}">
                    @endif
                    <input type="submit" class="btn btn-primary btn-rounded" name="submit" value="@if(!empty($realwedd)) Update @else Save @endif Real-Wedding">
                </div>
            </form>
        </div>
    </div>

    @if(!empty($realwedd))
    <div class="modal fade" id="delete_featured_image" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered register-tab">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                        <h2 class="m-0" >Confirmation</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="card-shadow-body">
                        <form data-action="{{ url('tools/real-wedding/image/') }}" class="submit">
                            <div class="row">
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <P class="text-danger">Are you sure, You want to delete this Featured Image</P>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $realwedd->id }}">
                                        <input type="hidden" name="type" value="profile_image">
                                        <button type="submit" class="btn btn-default">Delete Image</button>

                                        <button type="close" data-dismiss="modal" class="btn btn-secondary ">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endif


    @if($gallery->count() > 0)

        @foreach($gallery as $g)

        <!-- Modal for Delete gallery -->
        <div class="modal fade" id="delete_modal-{{ $g->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered register-tab">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                            <h2 class="m-0" >Confirmation</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>

                        

                        <div class="card-shadow-body">
                            <form data-action="{{ url('tools/real-wedding/image/') }}" class="submit">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <P class="text-danger">Are you sure, You want to delete this Gallery Image</P>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="hidden" name="gallery_id" value="{{ $g->id }}">
                                            <input type="hidden" name="type" value="gallery">
                                            <button type="submit" class="btn btn-default">Delete Image</button>
                                            
                                            <button type="close" data-dismiss="modal" class="btn btn-secondary ">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>            
        @endforeach
    @endif

@endsection

