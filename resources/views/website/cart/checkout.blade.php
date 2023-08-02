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



<div class="container">
      <div class="py-5 text-center">
        <h2>Checkout form</h2>
        {{-- <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
      </div>

          <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
              </h4>
              <ul class="list-group mb-3">
                @foreach ($contents as $content)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $content->name }}</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">{{ $currency_symbol->currency }} {{ $content->price }}</span>
                    </li>
                @endforeach
                    <li  class="text-danger list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Subtotal</h6>
                        <small class="text-muted">Subtotal</small>
                    </div>
                    <span class="text-danger">{{ $currency_symbol->currency }} {{ Cart::subtotal(); }} </span>
                    </li>



                <li class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                    <h6 class="my-0">Tax</h6>
                  </div>
                  <span class="text-success">{{ $currency_symbol->currency }} 0.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                    <h6 class="my-0">Shipping</h6>
                  </div>
                  <span class="text-success">{{ $currency_symbol->currency }} 0.00</span>
                </li>
                @if (Session::has('coupon'))
                    <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Coupon ({{ Session::get('coupon')['name'] }}) <abbr title="remove coupon"><a href="{{ route('remove.coupon') }}">x</a></abbr> </h6>

                    </div>
                    <span class="text-success">{{ $currency_symbol->currency }} {{ Session::get('coupon')['discount'] }}</span>
                    </li>
                @endif

                @if (Session::has('coupon'))
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{ $currency_symbol->currency }}{{ Session::get('coupon')['main_balance'] }}</strong>
                    </li>
                @else
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{ $currency_symbol->currency }} {{ Cart::total() }}</strong>
                    </li>
                @endif
              </ul>

              @if (!Session::has('coupon'))
                <form action="{{ route('apply.coupon') }}" method="POST" id="couponForm" class="card p-2">
                    @csrf
                    <div class="input-group">
                    <input type="text" class="form-control" name="coupon" placeholder="coupon code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Apply Coupon</button>
                    </div>
                    </div>
                </form>
              @endif

            </div>


                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form  action="{{ route('order.place') }}" method="post" class="needs-validation" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="c_name" placeholder="" value="" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Customer Phone</label>
                                <input type="text" class="form-control" id="phone" name="c_phone" placeholder="" value="" required="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="c_address" placeholder="1234 Main St" required="">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" name="c_email" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="c_country" placeholder="">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city">City</label>
                                <input type="city" class="form-control" id="city" name="c_city" placeholder="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="c_zipcode" placeholder="" required="">
                            </div>
                        </div>
                      <hr class="mb-4">


                      <h4 class="mb-3">Payment</h4>

                      <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                          <input id="credit" name="payment_type" type="radio" class="custom-control" value="paypal" checked="" required="">
                          <label class="custom-control-label pt-2" for="credit">Paypal</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input id="debit" name="payment_type" type="radio" class="custom-control" value="SSL Commerze" required="">
                          <label class="custom-control-label pt-2" for="debit">SSL Commerze</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input id="paypal" name="payment_type" type="radio" class="custom-control" value="hand cash" required="">
                          <label class="custom-control-label pt-2" for="paypal">hand cash</label>
                        </div>
                      </div>

                      <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>
                </div>


          </div>

    </div>


@endsection

@push('scripts')
    <script>

        // $(document).on("submit",'form#couponForm',function(e) {
        //     e.preventDefault();
        //     let form = new FormData(this);
        //     $.ajax({
        //         type: "post",
        //         url: "",
        //         data: form,
        //         contentType:false,
        //         processData:false,
        //         success: function(response) {
        //             if (response.status == false){
        //                 toastr.error(response.message);
        //             }else{
        //                 if (response.status == 'success')
        //                 {
        //                     toastr.success(response.message);
        //                 }else{
        //                     toastr.error(response.message);
        //                 }
        //             }
        //         }


        //     });
        // });

    </script>

@endpush
