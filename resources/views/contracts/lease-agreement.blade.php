@extends('frontend.frontend_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .lease-agreement {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .lease-agreement th,
        .lease-agreement td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .signature {
            margin-top: 20px;
            line-height: 2;
        }
    </style>
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
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                                                    alt=""></a></figure>
                                            <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                        </li>

                                    </ul>
                                    <div class="container mt-4">

                                        {{-- Upload form --}}
                                        <div class="mb-4">
                                            @if (!$contract->is_uploaded)
                                                <form action="{{ route('contracts.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="file" name="contractFile" required>
                                                    <button type="submit" class="btn btn-primary">Update Contract</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary disabled" disabled>Upload Disabled</button>
                                            @endif
                                        </div>

                                    </div>

                                    {{-- List of contracts --}}
                                    <div>
                                        <h2>Available Contracts</h2>
                                        <ul class="list-group">
                                            @foreach ($contracts as $contract)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $contract->file_path }}
                                                    <div>
                                                        <a href="{{ route('contracts.download', $contract->id) }}"
                                                            class="btn btn-primary me-2">Download</a>
                                                        <a href="{{ route('contracts.view', $contract->id) }}"
                                                            class="btn btn-info">View</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
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
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
