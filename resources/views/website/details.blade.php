@extends('layouts.website')
@section('styles')

@endsection


@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_responsive.css">

<script src="{{ asset('public/js/share.js') }}"></script>

@include('website.include.navbar')

<div class="single_product">
    <div class="container">
        <div class="row">
            @php
                $images=json_decode($product_details->images,true);
                $color=explode(',',$product_details->color);
			    $size=explode(',',$product_details->size);
            @endphp

            <!-- Images -->
            <div class="col-lg-1 order-lg-1 order-2">
                <ul class="image_list">
                    @foreach ($images as $item)
                        <li><img src="{{ asset('admin/product-images/'.$item) }}" alt=""></li>
                    @endforeach

                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-3 order-lg-2 order-1">
                <div class="image_selected"><img src="{{ $product_details->thumbnail != null ? asset('admin/product-images/'.$product_details->thumbnail)  : 'https://via.placeholder.com/80' }}" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-3">
                <div class="product_description">
                    <div class="product_category"> {{ $product_details->category->category_name }} -> {{ $product_details->subcategory->subcategory_name }}</div>
                    <div class="product_name">{{ $product_details->name }}</div>
                    <div class="text-secondary">{{ $product_details->brand->brand_name }} </div>
                    <div class="text-secondary">Stock Quantity :{{ $product_details->stock_quantity }} </div>
                    <div class="text-secondary">Unit :{{ $product_details->unit }} </div>

                    <div class="">
                        <span class="fa fa-star checked text-warning"></span>
                        <span class="fa fa-star checked text-warning"></span>
                        <span class="fa fa-star checked text-warning"></span>
                        <span class="fa fa-star checked text-warning"></span>
                        <span class="fa fa-star"></span>
                    </div>

                    <div class="product_text"><p>Lorem ipsum dolor sit amet,nisi tellus cursus urna, eget dictum lacus turpis.</p></div>




                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    @isset($product_details->size)
                                        <div class="col-6">
                                            <label for="">Size</label>
                                            <select name="size" id="" class="form-control">
                                                @foreach ($size as $row)
                                                    <option value="">{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endisset

                                    @isset($product_details->color)
                                        <div class="col-6">
                                            <label for="">Color</label>
                                            <select name="color" id="" class="form-control">
                                                @foreach ($color as $clr)
                                                    <option value="">{{ $clr }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    @endisset
                                </div>
                            </div>

                            <div class="clearfix pl-2" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->


                            </div>

                            @if ($product_details->discount_price==null)
                                <div class="product_price" style="margin-top: 20px">{{ $product_details->selling_price }}</div>
                            @else
                                <div class="product_price" style="margin-top: 20px">
                                    <del class="text-danger">{{ $currency_symbol->currency }}{{ $product_details->selling_price }}</del>
                                    {{ $currency_symbol->currency }}{{ $product_details->discount_price }}
                                </div>
                            @endif
                            {{-- <div class="product_price" style="margin-top: 20px">$2000</div> --}}

                            <div class="button_container">
                                <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 order-4">
                <p><b>pickup point of this product</b> <br>
                <i class="fa fa-map pr-1"></i>{{ $product_details->pickup_point->pickup_point_name }}</p>

                <p><b>Home Delivery</b> <br>
                    >> (3-5) days after the order placed. <br>
                    >> Cash On Delivery Avalible. <br>
                </p>

                <div>
                    <p><b>Product Video</b></p>

                      <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="250" height="150" type="text/html" src="https://www.youtube.com/embed/DBXH9jJRaDk?autoplay=0&fs=0&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=http://youtubeembedcode.com"><div><small><a href="https://youtubeembedcode.com/es/">youtubeembedcode.com/es/</a></small></div><div><small><a href="https://sms-lån-direkt-utbetalning.se/">sms-lån-direkt-utbetalning.se</a></small></div></iframe>

                      {{-- <iframe src="https://www.youtube.com/watch?v=PBykiW32kac&list=PLbC4KRSNcMnqxs0m8EgNNWuz_jhsLR6SY&index=41" height="200" width="300" title="Iframe Example"></iframe> --}}
                </div>

            </div>

        </div>

        <div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Product details of {{ $product_details->name }}</h4>
			  </div>
				<div class="card-body">
						{!! $product_details->description !!}
				</div>
			 </div>
			</div>
		</div><br>




    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Relative Product</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach ($related_product as $item)
                            <div class="owl-item">
                                <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image" style="height: 60px">
                                        <img src="{{ asset('admin/product-images/'.$item->thumbnail) }}" alt="">
                                    </div>
                                    <div class="viewed_content text-center">
                                        @if ($item->discount_price==null)
                                            <div class="product_price" style="">{{ $item->selling_price }}</div>
                                        @else
                                            <div class="product_price" style="font-size:16px;margin-top: 20px">
                                                <del class="text-danger">{{ $currency_symbol->currency }}{{ $item->selling_price }}</del>
                                                {{ $currency_symbol->currency }}{{ $item->discount_price }}
                                            </div>
                                        @endif

                                    </div>
                                        <div class="viewed_name"><a href="{{ route('product.details',$item->slug) }}">{{ substr($item->name, 0, 30).'...'; }}</a></div>
                                    <ul class="item_marks">
                                        {{-- <li class="item_mark item_discount">-25%</li> --}}
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
