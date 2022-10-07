@extends('front.layouts.user_layout')

@section('title', 'Review')


@section('main-container')

<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <h2>Reviews</h2>
        </div>
        <!-- Page Heading -->

        <!-- Reviews Section -->
        <div class="card-shadow">
            <div class="card-shadow-body">
                <div class="row no-gutters">
                    <div class="col-md-auto">
                        <div class="review-count">
                            <?php
                                $rating = vendor_helper::get_rating_of_vendor(Session::get('user_id'));
                            ?>
                            <span>{{ round($avg_count,1) }}</span>
                            <small>out of 5.0</small>
                            <div class="stars">
                                {!! str_repeat(' <i class="fa fa-star"></i> ', round($rating['avg']) ) !!}
                                {!! str_repeat(' <i class="fa fa-star-o"></i> ', 5 - round($rating['avg']) ) !!}                                   
                            </div>
                            <small>{{ $total }} Ratings</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <!-- review-option -->
                            <div class="col-md-4">
                                <div class="review-option">
                                    <div class="icon">
                                        <i class="fa fa-smile-o"></i>
                                    </div>
                                    <div class="count">
                                        <?php
                                            $five = vendor_helper::get_rating('5');
                                        ?>
                                        <span>5</span>
                                        <span class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>                                    
                                        </span>
                                        <span class="right">{{ $five['count'] }}</span>
                                        <div>
                                            <div class="bar-base">
                                                <div class="bar-filled bg-success" style="width: {{ $five['percentage'] }}%;">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- review-option -->

                            <!-- review-option -->
                            <div class="col-md-4">
                                <div class="review-option">
                                    <div class="icon">
                                        <i class="fa fa-smile-o"></i>
                                    </div>
                                    <div class="count">
                                        <?php
                                            $four = vendor_helper::get_rating('4');
                                        ?>
                                        <span>4</span>
                                        <span class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>                                  
                                        </span>
                                        <span class="right">{{ $four['count'] }}</span>
                                        <div>
                                            <div class="bar-base">
                                                <div class="bar-filled bg-success" style="width: {{ $four['percentage'] }}%;">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- review-option -->

                            <!-- review-option -->
                            <div class="col-md-4">
                                <div class="review-option">
                                    <div class="icon">
                                        <i class="fa fa-meh-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="count">
                                        <?php
                                            $three = vendor_helper::get_rating('3');
                                        ?>
                                        <span>3</span>
                                        <span class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>                                   
                                        </span>
                                        <span class="right">{{ $three['count'] }}</span>
                                        <div>
                                            <div class="bar-base">
                                                <div class="bar-filled bg-info" style="width: {{ $three['percentage'] }}%;">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- review-option -->

                            <!-- review-option -->
                            <div class="col-md-4">
                                <div class="review-option">
                                    <div class="icon">
                                        <i class="fa fa-frown-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="count">
                                        <?php
                                            $two = vendor_helper::get_rating('2');
                                        ?>
                                        <span >2 </span>
                                        <span class="stars">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>                                    
                                        </span>
                                        <span class="right">{{ $two['count'] }}</span>
                                        <div>
                                            <div class="bar-base">
                                                <div class="bar-filled bg-warning" style="width: {{ $two['percentage'] }}%;">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- review-option -->

                            <!-- review-option -->
                            <div class="col-md-4">
                                <div class="review-option">
                                    <div class="icon">
                                        <i class="fa fa-frown-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="count">
                                         <?php
                                            $one = vendor_helper::get_rating('1');
                                        ?>
                                        <span>1</span>
                                        <span class="stars">
                                            <i class="fa fa-star"></i>                                  
                                        </span>
                                        <span class="right">{{ $one['count'] }}</span>
                                        <div>
                                            <div class="bar-base">
                                                <div class="bar-filled bg-danger" style="width: {{ $one['percentage'] }}%;">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- review-option -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-shadow">
            <div class="card-shadow-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 datatable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_ratings as $rating)
                            <tr>
                                <td>{{ ucwords($rating->name) }}</td>
                                <td>{{ $rating->email }}</td>
                                <td>{{ ucwords($rating->user_type) }}</td>
                                <td>
                                    {{ $rating->rating }} 
                                    <span class="stars">
                                        <i class="fa fa-star"></i>                                  
                                    </span>
                                </td>
                                <td>{{ $rating->comment }}</td>
                                <td><span class="text-success">{{ date('M d, Y', strtotime($rating->created_at) ) }}</span></td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Reviews Section -->  
    </div>
</div>

@endsection