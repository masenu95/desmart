@extends('layouts.app')

@section('content')
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">Category</a></li>
				<li class="active">{{ $product->title }}</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <div class="gallery">
                <div id="photo-viewer"></div>
            </div>

             <div id="thumbnails" class="wow slideInUp">
                 @foreach ($product->images as $image )
                 <a href="{{ Storage::url( $image->name ) }}" class="thumb active" title="Pierre Cardin">
                    <img src="{{ Storage::url( $image->name ) }}" class="product-image" alt="products" />
                 </a>
                 @endforeach
        </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="product-desc animated zoomIn">
                <h5>{{ $product->title }}</h5>
                <span>Price:{{ number_format( $product->price,3 ) }}</span>
                <div class="product-name">
                    Availability: @if($product->status==1) In stock @else sold @endif
                    <p>
                        {{ $product->description }}
                    </p>
                    @if(Auth::check())
                        @if (Auth::user()->id==$product->user_id)
                            <a href="/Product/{{$product->id}}/edit"><i class="far fa-edit"></i></a>
                                <a href="#" onclick="var result=confirm('Are you sure you wish to delete this Product');
                                    if(result){
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                    }
                                    "><i class="fas fa-trash-alt"></i>

                                </a>
                                <form id="delete-form" action="{{route('Product.destroy',[$product->id])}}" method="POST" style="display:none">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                </form>
                        @else
                                <a href="tel:{{ $product->user->phone }}"><i class="fas fa-phone-alt"></i></a>
                                <a href="sms:+18664504185&body=Hi%2520there%252C%2520I%2527d%2520like%2520to%2520place%2520or%2520order%2520for..."><i class="fas fa-envelope"></i></a>
                                <a href="whatsapp://:{{$product->user->phone}}&body=enquire%20from%20smart%20market%20product%20{{$product->title}}%20with%20price%20{{$product->price}}%20http://127.0.0.1:8000/Product{{$product->id}}"><i class="fab fa-whatsapp"></i></a>
                        @endif
                    @else
                        <a href="tel:{{ $product->user->phone }}"><i class="fas fa-phone-alt"></i></a>
                        <a href="sms:+18664504185&body=Hi%2520there%252C%2520I%2527d%2520like%2520to%2520place%2520or%2520order%2520for..."><i class="fas fa-envelope"></i></a>
                        <a href="whatsapp://:{{$product->user->phone}}&body=enquire%20from%20smart%20market%20product%20{{$product->title}}%20with%20price%20{{$product->price}}%20http://127.0.0.1:8000/Product{{$product->id}}"><i class="fab fa-whatsapp"></i></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
