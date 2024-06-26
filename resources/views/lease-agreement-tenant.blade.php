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
    .lease-agreement th, .lease-agreement td {
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
                                <h1 style="text-align: center;">Lease Agreement</h1>
                                <table class="lease-agreement">
                                    <tbody>
                                        <tr>
                                            <th>Lessor:</th>
                                            <td>{{ $data['lessor_name'] }}, residing at {{ $data['lessor_address'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lessee:</th>
                                            <td>{{ $data['lessee_name'] }}, email {{ $data['lessee_email'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Property Address:</th>
                                            <td>{{ $data['property_address'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lease Term:</th>
                                            <td>1 year, from {{ $data['start_date'] }} to {{ $data['end_date'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Monthly Rent:</th>
                                            <td>{{ $data['rent_amount'] }} due monthly</td>
                                        </tr>
                                        <tr>
                                            <th>Security Deposit:</th>
                                            <td>Equivalent to three months' rent; two months' rent applied to the last two months of the lease term, and one month's rent held for damages or other dues</td>
                                        </tr>
                                        <tr>
                                            <th>Use of Premises:</th>
                                            <td>The premises are to be used for residential purposes only</td>
                                        </tr>
                                        <tr>
                                            <th>Utilities:</th>
                                            <td>Lessee is responsible for all utility payments</td>
                                        </tr>
                                        <tr>
                                            <th>Renewal:</th>
                                            <td>Notice of intention to renew must be given 7 days before the end of the term</td>
                                        </tr>
                                        <tr>
                                            <th>Subletting:</th>
                                            <td>Not allowed without Lessor's written consent</td>
                                        </tr>
                                        <tr>
                                            <th>Entry for Inspection:</th>
                                            <td>Lessor may enter for inspection, repairs, or showing to prospective tenants with reasonable notice</td>
                                        </tr>
                                        <tr>
                                            <th>Termination for Damage:</th>
                                            <td>Lease may be terminated if premises are substantially damaged by acts of God or other unforeseen events</td>
                                        </tr>
                                        <tr>
                                            <th>End of Lease:</th>
                                            <td>Lessee must return the premises in good condition, ordinary wear and tear excepted</td>
                                        </tr>
                                        <tr>
                                            <th>Default:</th>
                                            <td>Lessor may terminate the lease for non-payment of rent and enforce penalties</td>
                                        </tr>
                                        <tr>
                                            <th>Governing Law:</th>
                                            <td>{{ $data['jurisdiction'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
