@extends('layouts.website')
@section('styles')
    <style type="text/css" media="screen">
        .profile-image{
        position: relative;
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
        }

        .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 23%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
        }

        /*.text:hover {
        opacity: 0.3;
        }*/

        .middle:hover {
        opacity: 0.8;
        }

        .text {
        background-color: #04AA6D;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        }
        .list li{
            border-top:2px sloid rgb(14, 13, 13);
        }
    </style>
@endsection
    @section('navbar')
        {{-- @include('website.include.navbar') --}}
    @endsection

@section('content')



  <div class="container mt-4">

    @include('website.include.user.header')



    <div class="row">
      <div class="col-md-4">

        @include('website.include.user.profile')

      </div>
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
        </div>

        <div class="card-body">
            Name: {{ $order->c_name }} <br>
            Phone: {{ $order->c_phone }} <br>
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
            Date: {{ date('d-M-Y',strtotime($order->created_at)) }} <br>
            Subtotal: {{ $order->subtotal }} {{ $currency_symbol->currency }} <br>
            Total: {{ $order->total }} {{ $currency_symbol->currency }} <br>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
    <script>


    </script>

@endpush
