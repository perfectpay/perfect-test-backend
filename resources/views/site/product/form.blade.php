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

    <h1>Dashboard de Produtos</h1>
    <a href="{{ route('site.products.category',['category'=>$category->id])}}">Voltar</a>
    <div class='card mt-3'>
        <div class='card-body'>
        	@if(isset($product))
        	<h5 class="card-title mb-5">Editar Produto </h5>
        	@else
            <h5 class="card-title mb-5">Adicionar Novo Produto </h5>
            @endif  

@if(isset($product))
<form enctype="multipart/form-data" class="edit_client" action="{{route('site.product.edit',['category'=>$category,'product'=>$product])}}" method = "post">
	@method('PUT')

	<div class="form-group">
    <label for="inputname">ID</label>
    <input class="form-control" name="id" id="InputID" hidden value = "{{$product->id ?? ''}}">
    <input class="form-control" name="id" id="InputID" disabled value = "{{$product->id ?? ''}}">
  </div>

@else
<form enctype="multipart/form-data" class="send" action="{{ route('site.product.create',['category'=>1])}}" method = "post">
	
@endif 
@csrf

@if(!isset($product))
   <div class="form-group">
    <label for="FormControlFile1">Imagem</label>
    <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
@endif

  <div class="form-group">
    <label for="inputName">Nome</label>
    <input class="form-control" name="name" id="InputName" aria-describedby="nameHelp" placeholder="Nome do Produto" value = "{{$product->name ?? ''}}">
  </div>

    <div class="form-group">
    <label for="inputName" hidden>Category_ID</label>
    <input class="form-control" name="category_id" id="InputName" aria-describedby="nameHelp" placeholder="Nome do Produto" value = "{{$category->id ?? ''}}" hidden>
  </div>

    <div class="form-group">
    <label for="inputName">Preço</label>
    <input class="form-control" name="price" id="InputName" aria-describedby="nameHelp" placeholder="100.00 ou maior" value = "{{$product->name ?? ''}}">
  </div>

    <div class="form-group">
    <label for="inputName">Resumo</label>
    <input class="form-control" name="brief" id="InputName" aria-describedby="nameHelp" placeholder="Breve Resumo sobre o Produto" value = "{{$product->name ?? ''}}">
  </div>

  <div class="form-group">
    <label for="inputDescription">Description</label>
    <input class="form-control" name="description" id="description" aria-describedby="descriptionHelp" placeholder="Descricao do Produto" value = "{{$product->description ?? ''}}" >
  </div>






@if(isset($product))
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-pencil'></i>  Editar Produto</button>
@else
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo Produto</button>
@endif
</form>
        </div>
    </div>
@endsection

