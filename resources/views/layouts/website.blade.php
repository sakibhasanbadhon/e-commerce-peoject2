<!DOCTYPE html>
<html lang="en">
<head>
<title>STR SOFT BD</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/bootstrap4/bootstrap.min.css">
<link href="{{ asset('/') }}plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/toastr/toastr.css') }}">
<link href="{{ asset('/') }}assets/toastr.css" rel="stylesheet" />

@yield('styles')

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/product_responsive.css"> --}}

</head>

<body>

<div class="super_container">

	<!-- Header -->
        	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('/') }}images/phone.png" alt=""></div> {{ $currency_symbol->phone_one }}</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('/') }}images/mail.png" alt=""></div><a href="mailto:sakibhasan23333@gmail.com">{{ $currency_symbol->main_email }}</a></div>
						<div class="top_bar_content ml-auto">
							{{-- <div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">English<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Italian</a></li>
											<li><a href="#">Spanish</a></li>
											<li><a href="#">Japanese</a></li>
										</ul>
									</li>
									<li>
										<a href="#">Currency<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Taka</a></li>
											<li><a href="#">Dollar</a></li>
										</ul>
									</li>
								</ul>
							</div> --}}

                            @guest
                                <div class="top_bar_user">
                                    <div class="user_icon"><img src="{{ asset('/') }}images/user.svg" alt=""></div>
                                    <div><a href="{{ url('register') }}">Register</a></div>
                                    <div><a href="{{ url('login') }}">Sign in</a></div>
							    </div>

                            @else
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="{{ route('customer.dashboard') }}">Profile</a></li>
                                            <li><a href="#">Order list</a></li>
                                            <li><a href="#">Setting</a></li>
                                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            @endguest


						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="{{ asset('/') }}">STR Soft</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('/') }}images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

                    @php
                        $wishlist = DB::table('wishlists')->where('user_id',Auth::id())->count();
                    @endphp

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset('/') }}images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ route('wishlist') }}">Wishlist</a></div>
									<div class="wishlist_count">{{ $wishlist }}</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset('/') }}images/cart.png" alt="">
										<div class="cart_count"><span id="cartCount">{{ Cart::count() }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ route('cart') }}">Cart</a></div>
										<div class="cart_price" id="cartLoad">{{ $currency_symbol->currency }} {{ Cart::total() }} </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	@yield('navbar')

	</header>
	<!--End Header -->

    @yield('content')

	<!-- Footer -->
    @include('website.include.footer')

</div>


<script src="{{ asset('/') }}js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('/') }}styles/bootstrap4/popper.js"></script>
<script src="{{ asset('/') }}styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('/') }}plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('/') }}plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('/') }}plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('/') }}plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('/') }}plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('/') }}plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('/') }}plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('/') }}plugins/easing/easing.js"></script>
<script src="{{ asset('/') }}js/custom.js"></script>
<script src="{{ asset('/') }}js/product_custom.js"></script>
{{-- toastr message --}}
<script src="{{ asset('/') }}assets/toastr.min.js" type="text/javascript"></script>

<script>
        var _token = "{{ csrf_token() }}";
</script>

    <script>

        // summernote run code
        $(document).ready(function() {
            $('#summernote').summernote();
        });


        // sweet alert delete warning
        function deleteWarning(url,data_id){
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "To Delete this Data",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: "post",
                                data:{_token:_token,data_id:data_id},
                                success: function (response) {
                                    if (response.status =='success') {
                                        table.ajax.reload();
                                        toastr.success('Data Delete Success');
                                    }
                                },
                                error: function (response) {
                                    toastr.error('Opps! Something went wrong');

                                }
                            });
                        }
                    })
                }



        @if (Session::has('message'))
            var type ="{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'success':
                    toastr.success("{{ Session::get('message') }}")
                    break;
                case 'info':
                    toastr.info("{{ Session::get('message') }}")
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}")
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}")
                    break;
            }
        @endif



        function alertMessage(status,message){

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            switch(status) {
                case 'success':
                    toastr.success(message)
                    break;
                case 'error':
                    toastr.error(message)
                    break;
                case 'warning':
                    toastr.warning(message)
                    break;
                case 'info':
                    toastr.info(message)
                    break;
                }


            }

            @if (session()->get('success'))
                alertMessage('success',"{{ session()->get('success') }}");
            @elseif (session()->get('error'))
                alertMessage('error',"{{ session()->get('error') }}");
            @elseif (session()->get('info'))
                alertMessage('info',"{{ session()->get('info') }}");
            @elseif (session()->get('warning'))
                alertMessage('warning',"{{ session()->get('warning') }}");
            @endif


            $('.dropify').dropify();

    </script>


@stack('scripts')

</body>

</html>
