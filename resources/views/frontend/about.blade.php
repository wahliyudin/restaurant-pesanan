@extends('layouts.frontend.master')

@section('content')
    <!-- Start header -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End header -->

    <!-- Start About -->
    <div class="about-section-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('frontend/images/about-img.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                    <div class="inner-column">
                        <h1>Welcome To <span>Yamifood Restaurant</span></h1>
                        <h4>Little Story</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor suscipit feugiat. Ut
                            at pellentesque ante, sed convallis arcu. Nullam facilisis, eros in eleifend luctus, odio ante
                            sodales augue, eget lacinia lectus erat et sem. </p>
                        <p>Sed semper orci sit amet porta placerat. Etiam quis finibus eros. Sed aliquam metus lorem, a
                            pellentesque tellus pretium a. Nulla placerat elit in justo vestibulum, et maximus sem pulvinar.
                        </p>
                        <a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="inner-pt">
                        <p>Sed tincidunt, neque at egestas imperdiet, nulla sapien blandit nunc, sit amet pulvinar orci nibh
                            ut massa. Proin nec lectus sed nunc placerat semper. Duis hendrerit elit nec sapien porttitor,
                            ut pretium ipsum feugiat. Aenean volutpat porta nisi in gravida. Curabitur pulvinar ligula sed
                            facilisis bibendum. Nullam vitae nulla elit. </p>
                        <p>Integer purus velit, eleifend eu magna volutpat, porttitor blandit lectus. Aenean risus odio,
                            efficitur quis erat eget, mattis tristique arcu. Fusce in ante enim. Integer consectetur elit
                            nec laoreet rutrum. Mauris porta turpis nec tellus accumsan pellentesque. Morbi non quam tempus,
                            convallis urna in, cursus mauris. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Menu -->
    <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>Special Menu</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            @foreach ($categories as $category)
                                <button data-filter=".{{ $category->nama }}">{{ $category->nama }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 special-grid {{ $product->category->nama }}">
                        <div class="gallery-single fix">
                            <img src="{{ $product->photo }}" class="img-fluid" alt="Image">
                            <div class="why-text">
                                <h4>{{ $product->nama }}</h4>
                                <p>{{ $product->keterangan }}</p>
                                <h5>Rp. {{ numberFormat($product->harga) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Menu -->

    <!-- Start Contact info -->
    <div class="contact-imfo-box">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-volume-control-phone"></i>
                    <div class="overflow-hidden">
                        <h4>Phone</h4>
                        <p class="lead">
                            +01 123-456-4590
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-envelope"></i>
                    <div class="overflow-hidden">
                        <h4>Email</h4>
                        <p class="lead">
                            yourmail@gmail.com
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-map-marker"></i>
                    <div class="overflow-hidden">
                        <h4>Location</h4>
                        <p class="lead">
                            800, Lorem Street, US
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact info -->
@endsection
