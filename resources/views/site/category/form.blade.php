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
    <a href="{{ route('site.products')}}">Voltar</a>
    <div class='card mt-3'>
        <div class='card-body'>
        	@if(isset($category))
        	<h5 class="card-title mb-5">Editar Categoria </h5>
        	@else
            <h5 class="card-title mb-5">Adicionar Nova Categoria </h5>
            @endif  

@if(isset($category))
<form enctype="multipart/form-data" class="edit_client" action="{{route('site.category.edit',['category'=>$category])}}" method = "post">
	@method('PUT')

	<div class="form-group">
    <label for="inputname">ID</label>
    <input class="form-control" name="id" id="InputID" hidden value = "{{$category->id ?? ''}}">
    <input class="form-control" name="id" id="InputID" disabled value = "{{$category->id ?? ''}}">
  </div>

@else
<form enctype="multipart/form-data" class="send" action="{{ route('site.category.create')}}" method = "post">
	
@endif 
@csrf

@if(!isset($category))
   <div class="form-group">
    <label for="FormControlFile1">Imagem</label>
    <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
@endif

  <div class="form-group">
    <label for="inputName">Nome</label>
    <input class="form-control" name="name" id="InputName" aria-describedby="nameHelp" placeholder="Nome da Categoria" value = "{{$category->name ?? ''}}">
  </div>

  <div class="form-group">
    <label for="inputDescription">Description</label>
    <input class="form-control" name="description" id="description" aria-describedby="descriptionHelp" placeholder="Descricao" value = "{{$category->description ?? ''}}" >
  </div>






@if(isset($category))
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-pencil'></i>  Editar Categoria</button>
@else
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova Categoria</button>
@endif
</form>
        </div>
    </div>
@endsection

