
@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        @include('website.include.navbar')
    @endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/shop_styles.css">


<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('/') }}images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title"> {{ $page->page_title }}</h2>
    </div>
</div>




<div class="shop">
    <div class="container">
        <div class="row">
            {!! $page->page_description !!}
        </div>
    </div>
</div>






<script src="{{ asset('/') }}js/shop_custom.js"></script>
@endsection


@push('scripts')
    <script>

    </script>

@endpush
