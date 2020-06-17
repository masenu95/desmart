	@extends('layouts.app')

	@section('content')

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{url('./images/banner01.jpg')}}" alt="">
						<div class="banner-caption text-center">
							<h1>Bags sale</h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{url('./images/banner02.jpg')}}" alt="">
						<div class="banner-caption">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="{{url('./images/banner03.jpg')}}" alt="">
						<div class="banner-caption">
							<h1 class="white-color">New Product <span>Collection</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
					<!-- /banner -->
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
                @foreach ($products as $product )

                    <!-- Product Single -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="product product-single">
                            <div class="product-thumb">
                            <a href="Product/{{ $product->id}}"><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button></a>
                                <img src="{{ Storage::url( $product->images[0]->name ) }}" alt="" style="height:250px">
                            </div>
                            <div class="product-body">
                                <h3 class="product-price" style="text-align:center !imporant;width:100%">Price:{{ number_format($product->price,3 )}}</h3>
                                <h2 class="product-name"><a style="text-align:center" href="Product/{{ $product->id  }}">{{ substr($product->title, 0, 30)}}</a></h2>
                                <h2 class="product-name"><a href="#">Location:{{ $product->location }}</a></h2>
                                <div class="product-btns">
                                    <a href="sms:{{$product->user->phone}}&body=enquire%20from%20smart%20market%20product%20{{$product->title}}%20with%20price%20{{$product->price}}%20http://127.0.0.1:8000/Product{{$product->id}}"><button class="main-btn icon-btn"><i class="fa fa-comment"></i></button></a>
                                    <a href="whatsapp://:{{$product->user->phone}}&body=enquire%20from%20smart%20market%20product%20{{$product->title}}%20with%20price%20{{$product->price}}%20http://127.0.0.1:8000/Product{{$product->id}}"><button class="main-btn icon-btn"><i class="fab fa-whatsapp"></i></button></a>
                                    <a href="tel:{{ $product->user->phone }}"> <button class="main-btn icon-btn"><i class="fa fa-phone"></i></button></a>

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                           {{ $products->links() }}

		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	@endsection




