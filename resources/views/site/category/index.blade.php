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


    <h1>Categorias<a href="{{route('site.category.form')}}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova Categoria</a></h1>

<div class="card-deck">
	@foreach($categories as $category)

  <div class="card main-wrapper">
  	@if($category->image)
   <a href="{{route('site.products.category',['category' => $category])}}"> <img class="card-img-top" src="{{asset($category->image)}}" alt="Card image cap"></a>
    @else
    @php($defaultimage="img/No_Image_Available.jpg")
    <a href="{{route('site.products.category',['category' => $category])}}"><img class="card-img-top" src="{{asset($defaultimage)}}" alt="Card image cap"></a>
    @endif
    <div class="card-body">
      <h5 class="card-title">{{$category->name}}</h5>
      <p class="card-text">{{$category->description}}</p>
    </div>
    <div class="card-footer">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
      	<a  title="Entrar" href="{{route('site.products.category',['category' => $category])}}"> <button style = "width:20px" type="button" class="btn btn-primary"><i style="margin-left: -7px;" class='fa fa-door-open'></i></button></a>
      	<a title="Editar" href="{{route('site.category.edit',['category' => $category])}}"><button style = "width:20px" type="button" class="btn btn-light"><i style="margin-left: -7px" class='fa fa-pencil'></i></button></a>
        <a title="Deletar" href="{{route('site.category.delete',['category' => $category])}}"><button style = "width:20px" type="button" class="btn btn-danger"><i style="margin-left: -7px" class='fa fa-trash'></i></button></a>
      </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
        
        
      </div>
    </div>
  </div>

  @endforeach
</div>
@endsection
