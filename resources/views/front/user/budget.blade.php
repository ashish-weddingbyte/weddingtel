@extends('front.layouts.user_layout')

@section('title', 'Budget')


@section('main-container')


<div class="main-contaner">
    <div class="container">
        <!-- Page Heading -->
        <div class="section-title">
            <div class="d-sm-flex justify-content-between align-items-start">
                <h2>My Budget</h2>
                <a class="btn btn-default open-modal-check" href="javascript:void(0);" role="button" data-toggle="modal" data-target="#add_modal_category" ><i class="fa fa-plus"></i> New Category</a>
            </div>
            <div class="mt-3">
                @if(Session::has('message'))
                    <div class="alert {{session('class')}}">
                        <span>{{session('message')}}</sapn>
                    </div>
                @endif
            </div> 
        </div>
        <!-- Page Heading -->

        <div class="card-shadow">
            <div class="card-shadow-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="text-center">
                            <div id="donut"></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="budget-estimation">
                            <div class="d-flex w-100">
                                <div class="etimated-cost">
                                    <h3 class="mb-3">Expenses</h3>
                                    <div class="icon"><i class="weddingdir_saving_money"></i></div> 
                                    <p class="cost-price">INR {{ number_format($budget->estimated_cost) }}</p>
                                    <div>Estimated cost</div>
                                    <div class="mt-3">
                                        <a class="btn btn-link-primary p-0 open-modal-check" href="javascript:void(0);" data-toggle="modal" data-target="#edit_modal_estimated_cost"><i class="fa fa-pencil"></i>  Edit Budget</a>
                                    </div>
                                </div>
                                <div class="etimated-cost border-left">
                                    <h3 class="mb-3">Budget</h3>
                                    <div class="icon"><i class="weddingdir_money_stack"></i></div>
                                    <p class="cost-price final">INR {{ number_format($budget->final_cost) }}</p>
                                    <div>Final cost</div>
                                    <div class="mt-3">
                                        Paid: <strong>INR  {{ number_format($budget->final_cost) }}</strong> Pending: <strong>INR  {{ number_format($budget->pending) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                
        <!-- Modal for Add Budget Category -->
        <div class="modal fade" id="edit_modal_estimated_cost" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered register-tab">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                            <h2 class="m-0" >Edit Budget Estimated Cost</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="card-shadow-body">
                            <form data-action="{{ url('tools/budget/estimated-cost') }}" method="post" class="submit">
                                <div class="row">
                                    <div class="col-md-12 text-danger print-error-msg"></div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input id="estimated_cost" name="estimated_cost" type="number" value="{{$budget->estimated_cost}}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="hidden" name="budget_id" value="{{ $budget->id }}">
                                            <button type="submit" class="btn btn-default">Edit Estimated Cost</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <!-- Budget Start -->
            <div class="col-12 col-lg-3">
                <div class="nav flex-column nav-pills theme-tabbing-vertical budget-tab" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">

                    @foreach($budget_categories as $key => $category)

                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-{{ $category->id }}-tab" data-toggle="pill" href="#v-pills-{{ $category->id }}" role="tab" aria-controls="v-pills-{{ $category->id }}" aria-selected="true">{!! $category->icon !!} {{ ucwords($category->name) }}</a>

                    @endforeach

                </div>
            </div>
            <div class="col-12 col-lg-9 mt-4 mt-md-0">
                <div class="tab-content budget-tab-content" id="v-pills-tabContent">

                    
                    @foreach($budget_categories as $key => $category)

                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="v-pills-{{ $category->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $category->id; }}-tab">
                        <div class="card-shadow">
                            <div class="card-shadow-header p-0">
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="budget-head-icon"> {!! $category->icon !!}</span> 
                                        <span class="head-simple">{{ ucwords($category->name) }}</span> 
                                    </div>
                                    <div class="d-flex p-4 align-items-center justify-content-between ">
                                        <div class="cost-details">
                                            <span>Final Cost (Paid)</span>
                                            <div class="text-success">INR {{ number_format($category->final_cost) }}</div>
                                        </div>
                                        <div class="cost-details">
                                            <span>Estimated cost:</span>
                                            <div class="text-info">INR {{ number_format($category->estimated_cost) }}</div>
                                        </div>
                                        <div class="cost-details">
                                            <span>Pending</span>
                                            <div class="text-warning">INR {{ number_format($category->pending) }}</div>
                                        </div>
                                        <div class="remove-btn">
                                            <a href="javascript:" class="action-links edit open-modal-check" role="button" data-toggle="modal" data-target="#edit_modal_category-{{ $category->id }}"><i class="fa fa-pencil"></i></a> 
                                            <a href="javascript:" class="action-links open-modal-check" role="button" data-toggle="modal" data-target="#delete_modal-category-{{ $category->id }}"><i class="fa fa-trash"></i></a>
                                        </div>

                                        <!-- Modal for Edit Budget Category -->
                                        <div class="modal fade" id="edit_modal_category-{{ $category->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered register-tab">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                            <h2 class="m-0" >Edit Category</h2>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <div class="card-shadow-body">
                                                            <form data-action="{{ url('tools/budget/budget-category/edit/'.$category->id) }}" method="post" class="submit">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-danger print-error-msg"></div>
                                                                    @if($category->type == 'default' )
                                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                            <div class="form-group">
                                                                                <div class="alert alert-info">
                                                                                    You Can't Change Default Category Name
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                        <div class="form-group">
                                                                            <input id="category_name" {{ ($category->type == 'default' )? 'disabled' : '' }} name="category_name" type="text" value="{{ $category->name }}" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                        <div class="form-group">
                                                                            <input id="estimated_cost" name="estimated_cost" type="number" value="{{ $category->estimated_cost }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            
                                                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                                            <button type="submit" class="btn btn-default">Edit Category</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Delete Checklist -->
                                        <div class="modal fade" id="delete_modal-category-{{ $category->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
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
                                                            <form  data-action="{{ url('tools/budget/budget-category/delete/'.$category->id) }}" class="submit">
                                                                <div class="row">
                                                                    @if($category->type == 'default' )
                                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                            <div class="form-group">
                                                                                <div class="alert alert-info">
                                                                                    You Can't Delete Default Category, But All Expenses Will Are Deleted.
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            <P class="text-danger">Are you sure, You want to delete this Budget Category( {{ ucwords( $category->name) }} )</P>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                                            <button type="submit" class="btn btn-default">Delete Category</button>

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

                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-shadow-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Expense</th>
                                                <th scope="col">Estimate</th>
                                                <th scope="col">Paid</th>
                                                <th scope="col">Pending</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($buget_expense as $expense)
                                                @if($expense->budget_category_id == $category->id)
                                                    <tr>
                                                        <th scope="row">{{ $expense->expense_name }}</th>
                                                        <td>{{ $expense->estimated_cost }}</td>
                                                        <td>{{ $expense->paid }}</td>
                                                        <td>{{ $expense->pending }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="javascript:" class="action-links edit open-modal-check" role="button" data-toggle="modal" data-target="#edit_modal_expense-{{ $expense->id }}"><i class="fa fa-pencil"></i></a> 
                                                            <a href="javascript:" class="action-links open-modal-check" role="button" data-toggle="modal" data-target="#delete_modal-expense-{{ $expense->id }}"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                    <!-- modal for edit expense -->
                                                    <div class="modal fade" id="edit_modal_expense-{{ $expense->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered register-tab">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-0">
                                                                    <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                                        <h2 class="m-0" >Edit Expense for {{ ucwords($category->name) }}</h2>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                            </svg>
                                                                        </button>
                                                                    </div>

                                                                    <div class="card-shadow-body">
                                                                        <form data-action="{{ url('tools/budget/budget-expense/edit/'.$expense->id) }}" method="post" class="submit">
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-danger print-error-msg"></div>
                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                                    <div class="form-group">
                                                                                        <input id="expense_name" name="expense_name" type="text" value="{{ $expense->expense_name }}" class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                                    <div class="form-group">
                                                                                        <input id="estimated_cost" name="estimated_cost" type="number" value="{{ $expense->estimated_cost }}" class="form-control">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                                    <div class="form-group">
                                                                                        <input id="amount_paid" name="amount_paid" type="number" value="{{ $expense->paid }}" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" name="category_id" value="{{ $expense->budget_category_id }}">
                                                                                        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                                                                                        <button type="submit" class="btn btn-default">Edit Expense</button>
                                                                                    </div>
                                                                                </div>

                                                                                
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- modal for delete expense -->
                                                    <div class="modal fade" id="delete_modal-expense-{{ $expense->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
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
                                                                        <form  data-action="{{ url('tools/budget/budget-expense/delete/'.$expense->id) }}" class="submit">
                                                                            <div class="row">
                                                                                
                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <P class="text-danger">Are you sure, You want to delete this Expense of {{ ucwords( $category->name) }} Category</P>
                                                                                        <ul>
                                                                                            <li>Expense Name:- {{ ucwords($expense->expense_name) }}</li>
                                                                                            <li>Estimated Cost:- {{ $expense->estimated_cost }}</li>
                                                                                            <li>Amount Paid:- {{ $expense->paid }}</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" name="category_id" value="{{ $expense->budget_category_id }}">
                                                                                        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                                                                                        <button type="submit" class="btn btn-default">Delete Expense</button>

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
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center py-4 border-top">
                                    <button class="btn btn-outline-primary open-modal-check btn-rounded" role="button" data-toggle="modal" data-target="#add_modal_expense-{{ $category->id }}"><i class="fa fa-plus"></i> Add New Budget</button>
                                </div>
                               
                                <!-- Modal for Add Expense -->
                                <div class="modal fade" id="add_modal_expense-{{ $category->id }}" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered register-tab">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                                                    <h2 class="m-0" >Add New Expense for {{ ucwords($category->name) }}</h2>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="card-shadow-body">
                                                    <form data-action="{{ url('tools/budget/budget-expense/add') }}" method="post" class="submit">
                                                        <div class="row">
                                                            <div class="col-md-12 text-danger print-error-msg"></div>
                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                <div class="form-group">
                                                                    <input id="expense_name" name="expense_name" type="text" placeholder="Write Expense Name here" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                <div class="form-group">
                                                                    <input id="estimated_cost" name="estimated_cost" type="number" placeholder="Write Estimated Cost here" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                                <div class="form-group">
                                                                    <input id="amount_paid" name="amount_paid" type="number" placeholder="Write Amount Paid here" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                                    <button type="submit" class="btn btn-default">Add Expense</button>
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    @endforeach

                    
    
                </div>
            </div>
            <!-- Budget End -->
        </div>

        
    </div>
</div>


<!-- Modal for Add Budget Category -->
<div class="modal fade" id="add_modal_category" tabindex="-1" aria-labelledby="login_form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered register-tab">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3 px-4 bg-light-gray">
                    <h2 class="m-0" >Add New Category</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>

                <div class="card-shadow-body">
                    <form data-action="{{ url('tools/budget/budget-category/add') }}" method="post" class="submit">
                        <div class="row">
                            <div class="col-md-12 text-danger print-error-msg"></div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="category_name" name="category_name" type="text" placeholder="Write Category Name here" class="form-control">
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-group">
                                    <input id="estimated_cost" name="estimated_cost" type="number" placeholder="Write Estimated Cost here" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Add Category</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection