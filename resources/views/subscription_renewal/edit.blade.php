@extends('layouts.app')
@section('title')
  Edit Subscriptions
@endsection
@section('content')

    <div class="page-wrapper">

        @include('partials.navbar')

                  <!-- Page Content-->
                  <div class="page-content">
                    <div class="container-fluid"> 
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Subscription</h4>
                                        {{-- <p class="text-muted mb-4">Custom stylr example.</p> --}}
                                        <form class="" method="POST" action="{{ route('subscription.update', $subscription->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Category<span style="color: red">*</span></label>
                                                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                                            <option value="">>>-SELECT CATEGORY-<<</option>
                                                            @foreach($categories as $category)
                                                              <option {{ ($category->id == $subscription->category) ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        @error('category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Payment Cycle<span style="color: red">*</span></label>
                                                        <select name="payment_cycle" id="payment_cycle" class="form-control @error('payment_cycle') is-invalid @enderror">
                                                            <option value="">>>-SELECT PAYMENT CYCLE-<<</option>
                                                            @foreach ($paymentcycle as $item)
                                                                <option {{($item->id == $subscription->payment_cycle) ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('payment_cycle')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Subscription Name <span style="color: red">*</span></label>
                                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{$subscription->name}}" placeholder="Enter Name" >
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="useremail">Start Date<span style="color: red">*</span></label>
                                                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" required value="{{$subscription->start_date}}">
                                                        @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Staff<span style="color: red">*</span></label>
                                                        <select name="user" id="user" class="form-control @error('user') is-invalid @enderror">
                                                            <option value="">>>-SELECT USER-<<</option>
                                                            @foreach($users as $user)
                                                            <option {{($user->id == $subscription->user) ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->fname }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('user')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="useremail">Next Payment Date<span style="color: red">*</span></label>
                                                        <input type="date" name="next_payment_date" class="form-control @error('next_payment_date') is-invalid @enderror" required value="{{$subscription->next_payment_date}}">
                                                        @error('next_payment_date')
                                                            <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col-md-12">                            
                                                    <div class="form-group">
                                                        <label for="message">Description</label>
                                                        <textarea placeholder="Enter Description" class="form-control @error('description') is-invalid @enderror" rows="5" name="description">{{$subscription->description}}</textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div>
                        </div>
    
                    </div><!-- container -->
    
                    @include('partials.footer')
                </div>
                <!-- end page content -->

    </div>
    <!-- end page-wrapper -->

@endsection