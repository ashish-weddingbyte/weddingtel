@extends('front.layouts.main_layout')

@section('title', 'Blogs Details')


@section('main-container')

<!--  Page Breadcrumbs Start -->
<section class="breadcrumbs-page">
    <div class="container">
        <h1>Blog Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
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
                <div class="col-lg-8 col-md-12">
                    <!-- Post Blog -->
                    @if($blog)
                    <div class="post-content mb-0">
                        <!-- Post Blog Image -->
                        <div class="post-img">
                            <div class="single-post-featured-image">
                                <img src="{{ asset('storage/upload/blog/'.$blog->featured_image)}}" alt="">
                            </div>
                        </div>
                        <!-- Post Blog Image -->

                        <!-- Post Blog Content -->
                        <h3 class="blog-title">{{ $blog->title }}</h3>
                        <span class="meta-date">{{ date('M d, Y', strtotime($blog->created_at) ) }}</span>
                        <span class="post-category">
                            <a href="{{ url('/blogs/'.$blog->category_url ) }}">{{ $blog->category_name }}</a>
                        </span>

                        @if($blog->short_desc)
                        <div class="entry-content">
                            <blockquote class="blockquote-1 my-5">
                                {!! $blog->short_desc !!}
                            </blockquote>
                        </div>
                        @endif
                        
                        <div class="entry-content">
                            @if($blog->desc)
                                {!! $blog->desc !!}
                            @endif
                            

                            <!-- Tags/Socail Sharing -->
                            <div class="tag-wrap">
                                <div class="post-tags">
                                    <i class="fa fa-tags"></i>
                                    <a href="javascript:">Bride</a>
                                    <a href="javascript:">Makeup</a>
                                    <a href="javascript:">Groom</a>
                                    <a href="javascript:">Marriage</a>
                                    <a href="javascript:">Venue</a>
                                    <a href="javascript:">Makeup Artist</a>
                                </div>
                                <!-- <div class="social-sharing">
                                    <em>Share This</em> 
                                    <a href="" class="share-btn-facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript:" class="share-btn-twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="javascript:" class="share-btn-instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="javascript:" class="share-btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                </div> -->
                            </div>
                            <!-- Tags/Socail Sharing -->

                            <!-- Next/Previous Post -->
                            <div class="post-linking">
                                <div class="previous-post">
                                    @if($previous)
                                        <a href="{{ url('/blog').'/'.str_replace(' ','-',trim($previous->title)) }}">
                                            <small>Previous Post</small>
                                            {{ $previous->title }}
                                        </a>
                                    @endif
                                </div>
                                <div class="next-post">
                                    @if($next)
                                        <a href="{{ url('/blog').'/'.str_replace(' ','-',trim($next->title)) }}">
                                            <small>Next Post</small>
                                            {{ $next->title }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <!-- Next/Previous Post -->

                            <!-- Author Section -->
                            <div class="author-wrap">
                                <div class="thumb">
                                    <img src="{{ asset('front/images/author_img.png')}}" alt="">
                                </div>
                                <div class="content">
                                    <h3>Admin <small>(AUTHOR)</small></h3>
                                    <!-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p> -->
                                    <a href="{{ url('/blogs') }}" class="btn btn-default btn-rounded btn-md">View All Post</a>
                                </div>
                            </div>
                            <!-- Author Section -->  
                                
                        </div>
                        <!-- Post Blog Content -->
                        
                    
                    </div>
                    @endif
                    <!-- Post Blog -->
                </div>

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
