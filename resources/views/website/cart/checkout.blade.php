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
                <strong>{{ $currency_symbol->currency }}{{ Session::get('coupon')['mail_balance'] }}</strong>
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
          <form class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone">Customer Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
            </div>


            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="">
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <input type="state" class="form-control" id="state" name="state" placeholder="">
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zipcode" placeholder="" required="">
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">


            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control" checked="" required="">
                <label class="custom-control-label pt-2" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control" required="">
                <label class="custom-control-label pt-2" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control" required="">
                <label class="custom-control-label pt-2" for="paypal">Paypal</label>
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
