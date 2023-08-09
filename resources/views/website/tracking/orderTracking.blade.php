
@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        {{-- @include('website.include.navbar') --}}
    @endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/shop_styles.css">


<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('/') }}images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title"> Tracking Your Order Now </h2>
    </div>
</div>




<div class="shop">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-lg-8 p-3">
                <form action="{{ route('check.order') }}" method="POST">@csrf
                    <label for="order_id"> Order Id</label>
                    <input type="text" class="form-control" name="order_id" id="order_id" placeholder="write your order id"> <br>
                    <button class="btn btn-info"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>






<script src="{{ asset('/') }}js/shop_custom.js"></script>
@endsection


@push('scripts')
    <script>

    </script>

@endpush
