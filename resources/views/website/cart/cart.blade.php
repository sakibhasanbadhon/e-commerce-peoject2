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
                            @foreach ($cart_content as $item)
                                @php
                                    $DBproduct = DB::table('products')->where('id',$item->id)->first();
                                    $color=explode(',',$DBproduct->color);
                                    $size=explode(',',$DBproduct->size);
                                @endphp
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image">
                                        <img src="{{ asset('admin/product-images/'.$item->options->thumbnail) }}" alt="" width="80" height="80">
                                    </div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_text">{{ Str::substr($item->name, 0, 30) }}</div>
                                        </div>
                                        @if ($item->options->color !=null)
                                            <div class="cart_item_color cart_info_col">
                                                <div class="cart_item_text">
                                                    <select name="color" class="form-control color" data-id="{{ $item->rowId }}" style="min-width: 100px">
                                                        @foreach ($color as $colors)
                                                            <option value="{{ $colors }}" {{ $colors==$item->options->color ? 'selected' : '' }}>{{ $colors }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- {{ Cart::content() }} --}}
                                        @if ($item->options->size !=null)
                                            <div class="cart_item_size cart_info_col">
                                                <div class="cart_item_text">
                                                    <select name="size" class="form-control size" data-id="{{ $item->rowId }}" style="min-width: 100px">
                                                        @foreach ($size as $sizes)
                                                            <option value="{{ $sizes }}" {{ $sizes==$item->options->size ? 'selected' : '' }}>{{ $sizes }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        @endif

                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_text">
                                                <input class="form-control qty" type="number" data-id="{{ $item->rowId }}" name="qty" value="{{ $item->qty }}" style="width: 70px">
                                                {{-- <input type="hidden" id="{{ $item->rowid }}" class="cartId"> --}}
                                            </div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_text">{{ $currency_symbol->currency }}{{ $item->price }} X {{ $item->qty }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text">{{ $currency_symbol->currency }}{{ $item->price*$item->qty }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text">
                                                <a class="btn btn-danger btn-sm text-white px-2 cart_remove" id="{{ $item->rowId }}"> X </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- {{ Cart::content(); }} --}}

                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">{{ $currency_symbol->currency }} {{ Cart::total() }} </div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('cart.empty') }}" type="button" class="btn btn-outline-danger ">Empty Cart</a>
                        <button type="button" class="btn btn-outline-info">Chackout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
    <script>

        $(document).on('click',".cart_remove",function (e) {
            e.preventDefault();
             let button_id = $(this).attr("id");

            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {_token:_token,button_id:button_id},
                success: function (response) {
                    toastr.success(response);
                    location.reload();

                }
            });
        });

        // cart qty
        $(document).on('blur','.qty',function() {
            let qty = $(this).val();
            let cartId = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.qty.update') }}",
                type: "POST",
                data: {_token:_token,qty:qty,cartId:cartId},
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                }
            });
        })

        // cart color
        $(document).on('change','.color',function() {
            let color = $(this).val();
            let cartId = $(this).data('id');
            // alert($cartId);

            $.ajax({
                url: "{{ route('cart.color.update') }}",
                type: "POST",
                data: {_token:_token,color:color,cartId:cartId},
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                }
            });
        })

        // cart size
        $(document).on('change','.size',function() {
            let size = $(this).val();
            let cartId = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.size.update') }}",
                type: "POST",
                data: {_token:_token,size:size,cartId:cartId},
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                }
            });
        })


    </script>

@endpush
