@extends('frontend.frontend_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title-6.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>User Profile </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>User Profile </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">

            @php

                $id = Auth::user()->id;
                $userData = App\Models\User::find($id);

            @endphp

            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                  <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>User Profile </h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb"><a href="blog-details.html">
                                <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                 <p>{{ $userData->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">

                        </div>

                        @include('frontend.dashboard.dashboard_sidebar')

                      </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">

                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb"><img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                        <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                    </li>

                                </ul>
                                <div class="container">
                                    <h2>My Payment Logs</h2>
                                    @if ($myPaymentLogs->isEmpty())
                                        <p>No payment logs found.</p>
                                    @else
                                        <div class="table-responsive"> <!-- Add a wrapper for responsive table -->
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Amount</th>
                                                        <th>Recipient Email</th>
                                                        <th>Sender Email</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>Receipt Image</th>
                                                        <th>Action</th> <!-- Add a header for actions -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($myPaymentLogs as $log)
                                                        <tr>
                                                            <td>{{ $log->amount }}</td>
                                                            <td>{{ $log->recipient_email }}</td>
                                                            <td>{{ $log->sender_email }}</td>
                                                            <td>{{ $log->description }}</td>
                                                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                                                            <td>
                                                                @if ($log->receipt_image_path)
                                                                    <a href="{{ asset('storage/' . $log->receipt_image_path) }}" target="_blank">View Image</a>
                                                                @else
                                                                    No Image
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('rent-receipt-view', $log->id) }}" class="btn btn-primary">View Receipt</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

<!-- subscribe-section -->
<!-- <section class="subscribe-section bg-color-3">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                <div class="text">
                    <span>Subscribe</span>
                    <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                <div class="form-inner">
                    <form action="contact.html" method="post" class="subscribe-form">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email" required="">
                            <button type="submit">Subscribe Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- subscribe-section end -->


<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
