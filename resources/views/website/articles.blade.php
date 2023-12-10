@extends('../layouts-site.app')
@section('content')
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
				<h4 class="product-price">{{$article->user_name}}</h4>
				<h3 class="product-name"><a href="">{{ date('d-m-Y h:i A', strtotime($article->created_at)) }}</a></h3>
				<div class="product">
					<div class="product-img">
						<img width="80px" height="500px" src="http://127.0.0.1:8000{{$article->image}}">
					</div>
					<div class="product-body">
					<h4 class="product-price">{{$article->title}}</h4>
					<h4 class="product-price">{{$concatenatedTags}}</h4>
					<h3 class="product-name"><a href="">{{$article->description}}</a></h3>
					</div>
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->

<!-- /HOT DEAL SECTION -->
@endsection