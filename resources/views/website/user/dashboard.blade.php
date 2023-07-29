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
                <div class="card-body text-info">
                  <div class="card-title"> Total order</div>
                  <p class="card-text text-center">15</p>
                </div>
              </div>

              <div class="card mx-4">
                <div class="card-body text-info">
                  <div class="card-title"> Total order</div>
                  <p class="card-text text-center">15</p>
                </div>
              </div>

              <div class="card mx-4">
                <div class="card-body text-info">
                  <div class="card-title"> Total order</div>
                  <p class="card-text text-center">15</p>
                </div>
              </div>

              <div class="card mx-4">
                <div class="card-body text-info">
                  <div class="card-title"> Total order</div>
                  <p class="card-text text-center">15</p>
                </div>
              </div>

            </div>


            <h5 class="card-title">Order History</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#1001</td>
                  <td>2023-07-15</td>
                  <td>$150.00</td>
                </tr>
                <tr>
                  <td>#1002</td>
                  <td>2023-07-20</td>
                  <td>$75.00</td>
                </tr>
                <!-- Add more order rows here -->
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
