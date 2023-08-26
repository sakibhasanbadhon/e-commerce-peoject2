@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        @include('website.include.navbar')
    @endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_responsive.css">



<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_1.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text">+38 068 005 3570</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text">fastsales@gmail.com</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_3.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">10 Suffolk at Soho, London, UK</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
        {{-- <script src="plugins/parallax-js-master/parallax.min.js"></script> --}}
        {{-- <script src="plugins/easing/easing.js"></script> --}}
        {{-- <script src="js/blog_custom.js"></script> --}}
    <script>




    </script>

@endpush
