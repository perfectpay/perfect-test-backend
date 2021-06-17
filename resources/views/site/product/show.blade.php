@extends('layouts.layout')

@section('content')
    <h1>Produtos</h1>
	<h4><a href="{{route('site.products.category',['category' => $category])}}">Voltar Para {{$category->name}}</a></h4>
    <div class="card-deck card-header main-wrapper card-product-header">
    	<div class= "col-lg">
  	@if($product->image)
 <img class="card-img-top img-product" src="{{asset($product->image)}}" alt="Card image cap">
    @else
    @php($defaultimage="img/No_Image_Available.jpg")
    <img class="card-img-top img-product" src="{{asset($defaultimage)}}" alt="Card image cap">
    @endif
    	</div>
    	<div class= "col-lg">
    		<h1 class="card-title product-name">{{$product->name}}</h1>
      <h2 class="card-text product-price">R$ {{$product->price}}</h2>
      <h4 class="card-text product-brief">{{$product->brief}}</h4>

    	</div>

    </div>
<p></p>

    <div class="card-deck card-header main-wrapper">
    	<div class= "row">
    	<div class= "col-sm">
    		<h5 class="card-title">Descrição do Produto</h5>
      <p class="card-text">{{$product->description}}</p>
    	</div>
    	</div>
    </div>


</div>


@endsection
