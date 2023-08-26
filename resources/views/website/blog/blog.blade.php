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
    <div class="home_background parallax-window" data-parallax="scroll">
        <img src="{{ asset('images/shop_background.jpg') }}" alt="">
    </div>
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

                    @foreach ($blogs as $blog)
                        <div class="blog_post">
                            <div class="blog_image" style="background-image:url({{ asset('/admin/blog/'.$blog->thumbnail) }}"></div>
                            <div class="blog_text">{{ $blog->title }}</div>
                            <div class="blog_button"><a href="{{ route('blog.details',$blog->slug) }}"> Continue Reading </a></div>
                        </div>
                    @endforeach


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
