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

    <h1>Dashboard dos Clientes</h1>
    <a href="{{route('site.costumers')}}"><i class="fa fa-arrow-alt-circle-left" aria-hidden="true"></i> Voltar</a>
    <div class='card mt-3'>
        <div class='card-body'>
        	@if(isset($costumer))
        	<h5 class="card-title mb-5">Editar Cliente </h5>
        	@else
            <h5 class="card-title mb-5">Adicionar Novo Cliente </h5>
            @endif  

@if(isset($costumer))
<form class="edit_client" action="{{route('site.costumer.edit',['costumer'=>$costumer])}}" method = "post">
	@method('PUT')

	<div class="form-group">
    <label for="inputname">ID</label>
    <input class="form-control" name="id" id="InputID" hidden value = "{{$costumer->id ?? ''}}">
    <input class="form-control" name="id" id="InputID" disabled value = "{{$costumer->id ?? ''}}">
  </div>

@else
<form class="send_client" action="{{ route('site.costumer.create')}}" method = "post">
	
@endif 
@csrf
	<div class="form-group">
    <label for="inputname">Nome</label>
    <input class="form-control" name="name" id="InputName" aria-describedby="emailHelp" placeholder="Nome Completo" value = "{{$costumer->name ?? ''}}">
  </div>
  <div class="form-group">
    <label for="inputemail">Email address</label>
    <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Email" value = "{{$costumer->email ?? ''}}">
    <small id="emailHelp" class="form-text text-muted">Seu email não será compartilhado com outras instituições.</small>
  </div>

    <div class="form-group">
    <label for="inputcpf">CPF</label>
    <input class="form-control" name="cpf" id="InputCPF" placeholder="000.000.000-00" onkeyup="mascara_cpf()" maxlength="14" value = "{{$costumer->cpf ?? ''}}">
    <small id="cpfhelp" class="form-text text-muted">Seu CPF não será compartilhado com outras instituições.</small>
  </div>


@if(isset($costumer))
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-pencil'></i>  Editar Cliente</button>
@else
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo Cliente</button>
@endif
</form>
        </div>
    </div>
@endsection

