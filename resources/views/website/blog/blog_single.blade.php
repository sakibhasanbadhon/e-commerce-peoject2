@extends('layouts.website')
@section('styles')

@endsection
    @section('navbar')
        @include('website.include.navbar')
    @endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_single_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}styles/blog_single_responsive.css">

<div class="super_container">

	<div class="home">
		<div class="home_background parallax-window">
            <img style="width:100%;height:500px" src="{{ asset('/admin/blog/'.$blogs->thumbnail) }}" alt="">
        </div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">{{ $blogs->title }}</div>
					<div class="single_post_text">
                    <p>{!! $blogs->description !!}</p>
						<div class="single_post_quote text-center">
							<div class="quote_image"><img src="images/quote.png" alt=""></div>
							<div class="quote_text">Quisque sagittis non ex eget vestibulum. Sed nec ultrices dui. Cras et sagittis erat. Maecenas pulvinar, turpis in dictum tincidunt, dolor nibh lacinia lacus.</div>
							<div class="quote_name">Liam Neeson</div>
						</div>

						<p>Praesent ac magna sed massa euismod congue vitae vitae risus. Nulla lorem augue, mollis non est et, eleifend elementum ante. Nunc id pharetra magna.  Praesent vel orci ornare, blandit mi sed, aliquet nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

						@foreach ($similar as $item)
                        <div class="blog_post">
							<div class="blog_image" style="background-image:url({{ asset('/admin/blog/'.$item->thumbnail) }})"></div>
							<div class="blog_text">{{ $item->title }}</div>
							<div class="blog_button"><a href="{{ route('blog.details',$item->slug) }}">Continue Reading</a></div>
						</div>
                        @endforeach
						<!-- Blog post -->


					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
@endsection

@push('scripts')
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="js/blog_custom.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="js/blog_single_custom.js"></script>
    <script>




    </script>

@endpush
