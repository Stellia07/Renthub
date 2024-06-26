@extends('frontend.frontend_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Page Title-->
    <section class="page-title centred"
        style="background-image: url({{ asset('frontend/assets/images/background/page-title-6.jpg') }});">
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
                    $rentBills = App\Models\RentBill::where('tenant_email', $userData->email)->get(); // Fetch rent bills for logged-in user
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
                                            <img src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                                                alt=""></a></figure>
                                    <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                    <p>{{ $userData->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget category-widget">
                            <div class="widget-title"></div>
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
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                                                    alt=""></a></figure>
                                            <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                        </li>
                                    </ul>
                                    <form action="{{ route('payment-log.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="amount">Amount:</label>
                                            <input type="number" class="form-control" name="amount" id="amount"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="receipt_image_path">Receipt Image:</label>
                                            <input type="file" class="form-control" name="receipt_image_path"
                                                id="receipt_image_path" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient_email">Recipient Email:</label>
                                            <input type="email" class="form-control" name="recipient_email"
                                                id="recipient_email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sender_email">Sender Email:</label>
                                            <input type="email" class="form-control" name="sender_email" id="sender_email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_month">Payment Month:</label>
                                            <div class="custom-dropdown">
                                                <button class="custom-dropdown-button" type="button">Select Month</button>
                                                <ul class="custom-dropdown-list">
                                                    @foreach ($rentBills as $bill)
                                                        <li class="custom-dropdown-item" data-value="{{ $bill->due_date }}">{{ $bill->due_date }}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="payment_month" id="payment_month" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->

    <style>
        .form-group select {
            max-height: 300px;
            overflow-y: auto;
            z-index: 9999;
            position: relative;
        }

        .custom-dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-dropdown-button {
            width: 100%;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            cursor: pointer;
            text-align: left;
        }

        .custom-dropdown-list {
            display: none;
            position: absolute;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 9999;
        }

        .custom-dropdown-item {
            padding: 10px;
            cursor: pointer;
        }

        .custom-dropdown-item:hover {
            background: #f1f1f1;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            // Custom dropdown functionality
            $('.custom-dropdown-button').on('click', function() {
                $('.custom-dropdown-list').toggle();
            });

            $('.custom-dropdown-item').on('click', function() {
                var value = $(this).data('value');
                var text = $(this).text();
                $('.custom-dropdown-button').text(text);
                $('#payment_month').val(value);
                $('.custom-dropdown-list').hide();
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('.custom-dropdown').length) {
                    $('.custom-dropdown-list').hide();
                }
            });
        });
    </script>
@endsection
