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

    <h1>Dashboard dos Clientes</h1>
    <a href="{{ route('site.home')}}">Voltar</a>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Clientes
                <a href="{{route('site.costumer.create')}}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo Cliente</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Email
                    </th>
                    <th scope="col">
                        CPF
                    </th>
                    <th scope="col">
                        Ação
                    </th>
                </tr>
                @foreach($costumers as $costumer)
                <tr>
                    <td>
                        {{$costumer->id}}
                    </td>
                    <td>
                        {{$costumer->name}}
                    </td>
                    <td>
                        {{$costumer->email}}
                    </td>    
                    <td>
                        {{$costumer->cpf}}
                    </td>                     
                    <td>
                    	<div class="acao dash-cliente">
                        <a href="{{route('site.costumer.edit',['costumer'=>$costumer])}}" class="btn btn-info btn-sm" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{route('site.costumer.delete',['costumer'=>$costumer])}}" class='btn btn-danger btn-sm' title="Deletar"  onclick="return confirm('Tem Certeza que deseja apagar este cliente?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                    </td>
                </tr>
               @endforeach

            </table>
        </div>
    </div>
@endsection
