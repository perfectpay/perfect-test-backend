@extends('layouts.layout')

@section('content')
@if(Session::has('errors'))
@php($errors = Session::get('errors')->getMessageBag())

@foreach ($errors->all() as $error)
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ $error }}</p>
 @endforeach
@endif

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@if(Session::has('messagewarn'))
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagewarn') }}</p>
@endif

@if(Session::has('messagewarn2'))
<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('messagewarn2') }}</p>
@endif
    <h1>{{$category->name}}</h1>
<h4><a href="{{route('site.products')}}">Voltar Para Categorias</a></h4>
    <div class="card-deck card-header main-wrapper">
    	<div class= "row">
    	<div class= "col-sm">
  	@if($category->image)
   <a href="{{route('site.products.category',['category' => $category])}}"> <img class="card-img-top" src="{{asset($category->image)}}" alt="Card image cap"></a>
    @else
    @php($defaultimage="img/No_Image_Available.jpg")
    <a href="{{route('site.products.category',['category' => $category])}}"><img class="card-img-top" src="{{asset($defaultimage)}}" alt="Card image cap"></a>
    @endif
    	</div>
    	<div class= "col-sm">
    		<h5 class="card-title">{{$category->name}}</h5>
      <p class="card-text">{{$category->description}}</p>
    	</div>
    	</div>
    </div>
<p></p>


<h1>Produtos na categoria <a href="{{route('site.product.create',['category'=>$category])}}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo Produto</a></h1>


<div class="card-deck">

@foreach($category->products as $product)
  <div class="card main-wrapper">
  	@if($product->image)
   <a href="{{route('site.product.edit',['product' => $product])}}"> <img class="card-img-top" src="{{asset($product->image)}}" alt="Card image cap"></a>
    @else
    @php($defaultimage="img/No_Image_Available.jpg")
    <a href="{{route('site.product.edit',['product' => $product])}}"><img class="card-img-top" src="{{asset($defaultimage)}}" alt="Card image cap"></a>
    @endif
    <div class="card-body">
      <h5 class="card-title">{{$product->name}}</h5>
      <h5 style="color:blue;"class="card-title">R$ {{$product->price}}</h5>
      <p class="card-text">{{$product->brief}}</p>
    </div>
    <div class="card-footer">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a title="Editar" href="{{route('site.product.edit',['product' => $product])}}"><button  type="button" class="btn btn-light"><i  class='fa fa-pencil'></i></button></a>
        <a title="Deletar" href="{{route('site.product.delete',['product' => $product])}}" onclick="return confirm('Tem Certeza que deseja apagar este cliente?');"><button  type="button" class="btn btn-danger"><i  class='fa fa-trash'></i></button></a>
      </div>
    </div>
  </div>
@endforeach

</div>


@endsection

