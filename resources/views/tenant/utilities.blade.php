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

                                    <div class="container">
                                        <h2>Rent Billing</h2>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Tenant Email</th>
                                                    <th>Monthly Rent</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Receipt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rentBillings as $billing)
                                                    <tr>
                                                        <td>{{ $billing->tenant_email }}</td>
                                                        <td>{{ $billing->monthly_rent }}</td>
                                                        <td>{{ $billing->due_date }}</td>
                                                        <td>{{ $billing->status }}</td>
                                                        <td>{{ $billing->created_at }}</td>
                                                        <td>
                                                            @if ($billing->status == 'paid' && $billing->receipt_id)
                                                            <a href="{{ route('rent-receipt-view', $billing->receipt_id) }}" class="btn btn-primary">View Receipt</a>
                                                            @else
                                                                <button type="button" class="btn btn-warning" disabled>No Receipt Yet</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
