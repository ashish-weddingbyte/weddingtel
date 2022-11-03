@extends('front.layouts.main_layout')

@section('title', 'Blogs')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Blog List</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog List</li>
            </ol>
        </nav>
    </div>
</section>
<!--  Page Breadcrumbs End -->

<main id="body-content">

    <!-- Blog Page Start -->
    <section class="wide-tb-90">
        <div class="container">
            <div class="row">
                @if($blogs->count() > 0)
                <div class="col-lg-8 col-md-12">
                    <!-- Post Blog -->
                    @foreach($blogs as $blog)
                    <?php
                        $blog_url = url('/blog').'/'.str_replace(' ','-',trim($blog->title));
                    ?>
                    <div class="post-content">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <!-- Post Blog Image -->
                                <div class="post-img">
                                    <!-- <span class="sticky-post">
                                        <i class="fa fa-bookmark-o"></i>
                                    </span>
                                    <div class="img-hover">
                                        <i class="fa fa-plus"></i>
                                    </div> -->
                                    <img src="{{ asset('storage/upload/blog/'.$blog->featured_image)}}" alt="">
                                </div>
                                <!-- Post Blog Image -->
                            </div>

                            <div class="col-md-6">
                                <!-- Post Blog Content -->
                                <h3 class="blog-title"><a href="{{ $blog_url }}" class="post-title">{{ $blog->title }}</a></h3>
                                <!-- <span class="meta-date">{{ date('M d, Y', strtotime($blog->created_at) ) }}</span> -->
                                <span class="post-category">
                                    <a href="{{ url('/blogs/'.$blog->category_url ) }}">{{ $blog->category_name }}</a>
                                </span>

                                <div class="entry-content">
                                    <p>{{ $blog->short_desc }}</p>
                                </div>
                                <div class="read-more">
                                    <a href="{{ $blog_url }}" class="btn btn-link btn-link-primary">Read More</a>
                                </div>
                                <!-- Post Blog Content -->
                            </div>
                        </div>
                    
                    </div>
                    <!-- Post Blog -->
                    @endforeach

                    <div class="mt-4">
                        <div class="theme-pagination">
                            {!! $blogs->links() !!}
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-8 col-md-12">
                    <div class="text-center my-5">
                        <h3>Blog Not Available in {{ ucwords ($category) }} Category.</h3>
                    </div>
                </div>
                @endif


                <div class="col-lg-4 col-md-12">
                    <aside class="row sidebar-widgets">
                        <!-- Sidebar Primary Start -->
                        <div class="sidebar-primary col-lg-12 col-md-6">
                            <!-- Widget Wrap -->
                            <!-- <form class="sidebar-search">
                                <input type="text" class="form-control" placeholder="Enter here search...">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </form> -->
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Categories</h3>
                                @if($categories)
                                <ul class="list-unstyled icons-listing mb-0 widget-listing arrow">
                                    @foreach($categories as $category)
                                    <li><a href="{{ url('/blogs/'.$category->category_url ) }}">{{ $category->category_name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <!-- Widget Wrap -->

                            <!-- Widget Wrap -->
                            <div class="widget">
                                <h3 class="widget-title">Popular Posts</h3>
                                
                                <div class="popular-post">
                                    @if($popular_blogs)
                                    <ul class="list-unstyled">
                                        @foreach($popular_blogs as $blog)
                                        <?php
                                            $blog_url = url('/blog').'/'.str_replace(' ','-',trim($blog->title));
                                        ?>
                                        <li>
                                            <img src="{{ asset('storage/upload/blog/'.$blog->featured_image)}}" alt="">
                                            <div>
                                                <h6><a href="{{ $blog_url }}">{{ $blog->title }}</a></h6>
                                                <small>{{ date('M d, Y', strtotime($blog->created_at) ) }}</small>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            <!-- Widget Wrap -->
                        </div>
                        <!-- Sidebar Primary End -->

                        <!-- Sidebar Secondary Start -->
                        <div class="sidebar-secondary col-lg-12 col-md-6">
                            <!-- Widget Wrap -->
                            <!-- <div class="widget">
                                <h3 class="widget-title">Archives</h3>
                                <ul class="list-unstyled icons-listing mb-0 widget-listing arrow">
                                    <li><a href="javascript:">September</a></li>
                                    <li><a href="javascript:">August</a></li>
                                    <li><a href="javascript:">July</a></li>
                                    <li><a href="javascript:">June</a></li>
                                    <li><a href="javascript:">May</a></li>
                                </ul>
                            </div> -->
                            <!-- Widget Wrap -->


                            <!-- Widget Wrap -->
                            <!-- <div class="widget">
                                <h3 class="widget-title">Tags</h3>
                                <div class="tags">
                                    <a href="javascript:">Cake</a>
                                    <a href="javascript:">Decoration</a>
                                    <a href="javascript:">Dress</a>
                                    <a href="javascript:">Restaurants</a>
                                    <a href="javascript:">Venue</a>
                                </div>
                            </div> -->
                            <!-- Widget Wrap -->
                        </div>
                        <!-- Sidebar Secondary End -->

                        
                    </aside>
                </div>
            </div>                
        </div>
    </section>
    <!-- Blog Page End -->
</main>

@endsection
