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
                @if(!empty($blogs))
                    @foreach($blogs as $blog)
                    <?php
                        $blog_url = url('/blog').'/'.str_replace(' ','-',trim($blog->title));
                    ?>
                    <div class="col-lg-4 col-md-6 my-3">
                        <!-- Post Blog -->
                        <div class="blog-wrap-home">                            
                            <div class="post-content">
                                <!-- Post Blog Image -->
                                <div class="post-img blog-image">
                                    <img src="{{ asset('storage/upload/blog/'.$blog->featured_image)}}" alt="">
                                </div>
                                <!-- Post Blog Image -->
                                <!-- Post Blog Content -->
                                <div class="home-content">                                    
                                    <!-- <span class="meta-date">{{ date('M d, Y', strtotime($blog->created_at) ) }}</span> -->

                                    <div class="mt-auto">
                                        <span class="post-category">
                                            <a href="{{ url('/blogs/'.$blog->category_url ) }}">{{ $blog->category_name }}</a>
                                        </span>
                                        <h3 class="blog-title"><a href="{{ $blog_url }}" class="post-title">{{ $blog->title }}</a></h3>
                                        <div class="entry-content">
                                            <!-- <p>Quis autem vel eum prehenderit qui in ea voluptate velit esse quam nihil mole.</p> -->
                                        </div>
                                        <div class="read-more">
                                            <a href="{{ $blog_url }}" class="btn btn-link btn-link-default">Read More</a>
                                        </div>               
                                    </div>                     
                                </div>                   
                                <!-- Post Blog Content -->
                            </div>                            
                        </div>
                        <!-- Post Blog -->
                    </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="text-center my-5">
                            <h3>Blog Not Available in {{ ucwords ($category) }} Category.</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <div class="theme-pagination">
                {!! $blogs->links() !!}
            </div>
        </div>

    </section>
    <!-- Blog Page End -->
</main>

@endsection
