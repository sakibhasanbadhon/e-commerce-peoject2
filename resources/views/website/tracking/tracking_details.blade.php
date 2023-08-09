
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
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Order History</h5>
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">product</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">subtotal</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($order_details as $key=>$item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->single_price }}{{ $currency_symbol->currency }}</td>
                                        <td>{{ $item->subtotal_price }}{{ $currency_symbol->currency }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="card-body boder-top" style="background: #f2f2f2;border-top:2px solid #dbd7d7">
                        <div class="row">

                        <div class="col-md-3">
                            Name: {{ $order->c_name }} <br>
                            Phone: {{ $order->c_phone }} <br>
                        </div>

                        <div class="col-md-3">
                            Date: {{ date('d-M-Y',strtotime($order->created_at)) }} <br>
                            Subtotal: {{ $order->subtotal }} {{ $currency_symbol->currency }} <br>
                            Total: {{ $order->total }} {{ $currency_symbol->currency }} <br>
                        </div>

                        <div class="col-md-3">
                            Status: @if($order->status == 0)
                                    <span class="badge badge-danger"> Order Pending</span>
                                @elseif($order->status == 1)
                                    <span class="badge badge-info"> Order Received</span>
                                @elseif($order->status == 2)
                                    <span class="badge badge-primary"> Order Shipped</span>
                                @elseif($order->status == 3)
                                    <span class="badge badge-success"> Order Done</span>
                                @elseif($order->status == 4)
                                    <span class="badge badge-primary"> Order Return</span>
                                @elseif($order->status == 5)
                                    <span class="badge badge-danger"> Order Cencel</span>
                                @endif <br>
                        </div>

                        </div>


                    </div>
              </div>
            </div>
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
