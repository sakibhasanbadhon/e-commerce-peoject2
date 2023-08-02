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
            <div class="row my-3">

              <div class="card px-2 mx-4">
                <div class="card-body text-success">
                  <div class="card-title"> Total Order</div>
                  <p class="card-text text-center">{{ $total_orders }}</p>
                </div>
              </div>

              <div class="card mx-4">
                <div class="card-body text-success">
                  <div class="card-title"> Complete Order</div>
                  <p class="card-text text-center">{{ $complete_orders }}</p>
                </div>
              </div>

            <div class="card mx-4">
                <div class="card-body text-warning">
                <div class="card-title"> Return Order</div>
                <p class="card-text text-center">{{ $return_orders }}</p>
                </div>
            </div>

              <div class="card mx-4">
                <div class="card-body text-danger">
                  <div class="card-title"> Cencel Order</div>
                  <p class="card-text text-center">{{ $cancel_orders }}</p>
                </div>
              </div>

            </div>


            <h5 class="card-title">Order History</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total</th>
                  <th scope="col">Payment Type</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
                <tbody>

                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at))}}</td>
                            <td>{{ $item->total }} {{ $currency_symbol->currency }}</td>
                            <td>{{ $item->payment_type }}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="badge badge-danger"> Order Pending</span>
                                @elseif($item->status == 1)
                                    <span class="badge badge-info"> Order Received</span>
                                @elseif($item->status == 2)
                                    <span class="badge badge-primary"> Order Shipped</span>
                                @elseif($item->status == 3)
                                    <span class="badge badge-success"> Order Done</span>
                                @elseif($item->status == 4)
                                    <span class="badge badge-primary"> Order Return</span>
                                @elseif($item->status == 5)
                                    <span class="badge badge-danger"> Order Cencel</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
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
