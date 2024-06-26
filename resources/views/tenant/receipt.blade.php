{{-- resources/views/rent_receipt_view.blade.php --}}


@extends('frontend.frontend_dashboard')
@section('main')

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .receipt-container {
        width: 60%; /* Adjusted width for better readability */
        margin: 20px auto; /* Centered with more vertical space */
        padding: 20px;
        border: 2px solid #000; /* Solid border for clear definition */
        background-color: #f9f9f9; /* Light background to differentiate from the editable form */
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .content-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 10px; /* Added padding for better spacing */
        background-color: white; /* White background to highlight each row for readability */
        border-bottom: 1px solid #eee; /* Light border for subtle separation */
    }

    .content-row label {
        flex: 0 0 120px;
        font-weight: bold; /* Make labels bold for better visibility */
    }

    .content-row span {
        flex: 1;
        text-align: right; /* Aligning text to the right for consistency with the input form */
    }

    .signature {
        border-top: 1px solid #000;
        padding-top: 10px;
        margin-top: 20px;
        text-align: right;
    }
</style>

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
                                <div class="receipt-container">
                                    <div class="header">
                                        <h2>Rent Receipt</h2>
                                    </div>
                                    <div class="content-row">
                                        <label>Date of Payment:</label>
                                        <span>{{ $dateOfPayment }}</span>
                                    </div>
                                    <div class="content-row">
                                        <label>Receipt Number:</label>
                                        <span>{{ $receiptNumber }}</span>
                                    </div>
                                    <div class="content-row">
                                        <label>Amount Paid:</label>
                                        <span>{{ $amountPaid }}</span>
                                    </div>
                                    <div class="content-row">
                                        <label>Property Address:</label>
                                        <span>{{ $propertyAddress }}</span>
                                    </div>
                                    <div class="content-row">
                                        <label>Tenant’s Name:</label>
                                        <span>{{ $tenantName }}</span>
                                    </div>
                                    <div class="content-row">
                                        <label>Landlord’s Name:</label>
                                        <span>{{ $landlordName }}</span>
                                    </div>
                                    <div class="signature">
                                        <label>Signature of the Landlord:</label>
                                        <span>{{ $landlordName }}</span> <!-- Placeholder for signature, considering it's a view mode -->
                                    </div>
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
