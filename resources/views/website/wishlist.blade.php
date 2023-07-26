@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        @include('website.include.navbar')
    @endsection

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/cart_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/cart_styles.css">

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($products as $wish_product)

                                <li class="cart_item clearfix">
                                    <div class="cart_item_image">
                                        <img src="{{ asset('admin/product-images/'.$wish_product->product->thumbnail) }}" alt="" width="80" height="80">
                                    </div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_text">{{ Str::substr($wish_product->product->name, 0, 30) }}</div>
                                        </div>




                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_text">
                                                @if ($wish_product->product->discount_price == null )
                                                    {{ $currency_symbol->currency }} {{ $wish_product->product->selling_price }}
                                                @else
                                                {{ $currency_symbol->currency }} {{ $wish_product->product->discount_price }} </div>
                                                @endif
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text"> {{ $wish_product->product->created_at->format('d/m/Y') }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text">
                                                <a href="{{ route('product.details',$wish_product->product->slug) }}" class="btn btn-danger btn-sm text-white px-2 "> Add to cart </a>
                                            </div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text">
                                                <a href="{{ route('remove.product.wishlist',$wish_product->id) }}" class="btn btn-danger btn-sm text-white px-2"> x </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">{{ $currency_symbol->currency }} {{ Cart::total() }} </div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('empty.wishlist') }}" type="button" class="btn btn-outline-danger">Clear Wishlist</a>
                        <a href="{{ url('/') }}" type="button" class="btn btn-outline-info">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
    <script>


    </script>

@endpush
