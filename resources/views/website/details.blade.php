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
                        <li><img class="product_images" src="{{ asset('admin/product-images/'.$item) }}" alt=""></li>
                    @endforeach

                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-3 order-lg-2 order-1">
                <div class="image_selected"><img id="display_image" src="{{ $product_details->thumbnail != null ? asset('admin/product-images/'.$product_details->thumbnail)  : 'https://via.placeholder.com/80' }}" alt=""></div>
            </div>

            @php
                $review_5 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',5)->count();
                $review_4 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',4)->count();
                $review_3 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',3)->count();
                $review_2 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',2)->count();
                $review_1 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',1)->count();

                $sum_rating=DB::table('reviews')->where('product_id',$product_details->id)->sum('rating');
                $count_rating=DB::table('reviews')->where('product_id',$product_details->id)->count('rating');
            @endphp

            <!-- Description -->
            <div class="col-lg-4 order-3">
                <div class="product_description">
                    <div class="product_category"> {{ $product_details->category->category_name }} -> {{ $product_details->subcategory->subcategory_name }}</div>
                    <div class="product_name">{{ $product_details->name }}</div>
                    <div class="text-secondary">{{ $product_details->brand->brand_name }} </div>
                    <div class="text-secondary">Stock Quantity :{{ $product_details->stock_quantity }} </div>
                    <div class="text-secondary">Unit :{{ $product_details->unit }} </div>

                    @if($sum_rating !=NULL)
					 	@if(intval($sum_rating/$count_rating) == 5)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@else
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@endif
					@endif


                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    @isset($product_details->size)
                                        <div class="col-6">
                                            <label for="">Size</label>
                                            <select name="size" id="" class="custom-select form-control form-control-sm" style="min-width: 120px">
                                                @foreach ($size as $row)
                                                    <option value="">{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endisset

                                    @isset($product_details->color)
                                        <div class="col-6">
                                            <label for="">Color</label>
                                            <select name="color" id="" class="custom-select form-control form-control-sm" style="min-width: 120px">
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
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1" class="form-control-sm">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->


                            </div>

                            @if ($product_details->discount_price==null)
                                <div class="product_price" style="margin-top: 20px">{{ $currency_symbol->currency }} {{ $product_details->selling_price }}</div>
                            @else
                                <div class="product_price" style="margin-top: 20px">
                                    <del class="text-danger">{{ $currency_symbol->currency }}{{ $product_details->selling_price }}</del>
                                    {{ $currency_symbol->currency }}{{ $product_details->discount_price }}
                                </div>
                            @endif
                            {{-- <div class="product_price" style="margin-top: 20px">$2000</div> --}}

                            <div class="button_container">
                                <button type="button" class="btn btn-sm btn-info">Add to Cart</button>
                                <a href="{{ route('add.wishlist',$product_details->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-heart"></i></a>

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

        <div class="row mt-5">
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

            <div class="card">
                <div class="card-header">
                    <h4>Reting Review of: {{ $product_details->name }}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p style="margin-bottom: 5px">Avarage Review of  {{ $product_details->name }} </p>

                            @if($sum_rating !=NULL)
					 	@if(intval($sum_rating/$count_rating) == 5)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star text-warning"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@else
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@endif
					@endif


                        </div>

			            <div class="col-md-4">
                            <p>Total Review of the product</p>

                            <div style="margin-top: -10px">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <span> Total {{ $review_5 }}</span>
                            </div>
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star"></i>
                                <span>total {{ $review_4 }}</span>
                            </div>
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>total {{ $review_3 }}</span>
                            </div>
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>total {{ $review_2 }}</span>
                            </div>
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>total {{ $review_1 }}</span>
                            </div>

				        </div>

                        <div class="col-md-5">
                            <form action="{{ route('review.store') }}" method="post">
                                @csrf
                                <input name="product_id" type="hidden" value="{{ $product_details->id }}">
                                <p style="margin-bottom: 5px">Write your review </p>
                                <textarea class="p-2" name="review" cols="40" rows="2" placeholder="write a review for this product" required></textarea>

                                <p>
                                    select your rating
                                    <select class="custom-select" name="rating" id="" style="min-width: 30px" required>
                                        <option value="">please select rating</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </p>
                                @if (Auth::check())
                                    <button class="btn btn-primary "> <i class="fa fa-star text-warning"></i> Submit review</button>
                                @else
                                    Please at first login to your account for review.
                                @endif

                            </form>

                        </div>

                    </div>
			    </div>
		</div><br>

        <h3 class="mt-5"> All Review Of {{ $product_details->name }} </h3>

        <div class="row py-2">
            @foreach ($review as $item)
                <div class="col-lg-6 py-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $item->user->name }} ({{ date('d F ,Y'),strtotime($item->review_data) }}) </h5>
                        </div>
                        <div class="card-body">
                            {{ $item->review }}

                            @if ($item->rating==1)
                            <div>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            @elseif ($item->rating==2)
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            @elseif ($item->rating==3)
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            @elseif ($item->rating==4)
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            @elseif ($item->rating==5)
                            <div>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> <br>
            @endforeach



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
                                        <img src="{{ asset('admin/product-images/'.$item->thumbnail) }}" alt="" height="100%" width="60%">
                                    </div>
                                    <div class="viewed_content text-center">
                                        @if ($item->discount_price==null)
                                            <div class="product_price" style="font-size:16px;margin-top: 20px">{{ $currency_symbol->currency }} {{ $item->selling_price }}</div>
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
    <script>
        $(document).ready(function() {
            $(".product_images").click(function() {
                var imageSrc = $(this).attr("src");
                $("#display_image").attr("src", imageSrc);
                $("#display_image").show();
            });
        });
    </script>
@endpush
