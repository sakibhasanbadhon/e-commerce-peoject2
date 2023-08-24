@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        @include('website.include.navbar')
    @endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_responsive.css">

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Technological Blog</h2>
    </div>
</div>


<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_1.jpg)"></div>
                        <div class="blog_text">Vivamus sed nunc in arcu cursus mollis quis et orci. Interdum et malesuada.</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('') }}images/blog_2.jpg)"></div>
                        <div class="blog_text">Cras lobortis nisl nec libero pulvinar lacinia. Nunc sed ullamcorper massa.</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_3.jpg)"></div>
                        <div class="blog_text">Fusce tincidunt nulla magna, ac euismod quam viverra id. Fusce eget metus feugiat</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_4.jpg)"></div>
                        <div class="blog_text">Etiam leo nibh, consectetur nec orci et, tempus tempus ex</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_5.jpg)"></div>
                        <div class="blog_text">Sed viverra pellentesque dictum. Aenean ligula justo, viverra in lacus porttitor</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_6.jpg)"></div>
                        <div class="blog_text">In nisl tortor, tempus nec ex vitae, bibendum rutrum mi. Integer tempus nisi</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_7.jpg)"></div>
                        <div class="blog_text">Make Life Easier on Yourself by Accepting “Good Enough.” Don’t Pursue Perfection.</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_8.jpg)"></div>
                        <div class="blog_text">13 Reasons You Are Failing At Life And Becoming A Bum</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                    </div>

                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{ asset('/') }}images/blog_9.jpg)"></div>
                        <div class="blog_text">4 Steps to Getting Anything You Want In Life</div>
                        <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
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
