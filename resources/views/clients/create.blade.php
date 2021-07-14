@extends('layout')

@section('content')
    <h1>Adicionar Cliente</h1>
        @if($errors->all())
            @foreach($errors->all() as $error)
                <x-message color="danger">
                <p class="icon-asterisk">{{$error}}</p>
                </x-message>
            @endforeach
        @endif
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('clients.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <h5 class="card-title mb-5">Informações do cliente
                    <a href="{{ route('home') }}" class='btn btn-primary float-right btn-sm rounded-pill'><i class='fa fa-home'></i>  Home</a>
                    <a href="{{ route('sales.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a>
                </h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control " id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="document">CPF</label>
                    <input type="text" class="form-control" id="document" name="document" placeholder="Somente Números" value="{{ old('document') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11" maxlength="11">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
