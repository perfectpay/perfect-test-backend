@extends('layout')

@section('content')
    <h1>Editar Cliente</h1>
        @if($errors->all())
            @foreach($errors->all() as $error)
                <x-message color="danger">
                <p class="icon-asterisk">{{$error}}</p>
                </x-message>
            @endforeach
        @endif

        @if(session()->exists('message'))
            <x-message color="{{session()->get('color')}}">
                <p class="icon-asterisk">{{session()->get('message')}}</p>
            </x-message>
        @endif
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ old('name') ?? $client->name }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control " id="email" name="email" value="{{ old('email') ?? $client->email }}">
                </div>
                <div class="form-group">
                    <label for="document">CPF</label>
                    <input type="text" class="form-control" id="document" name="document" placeholder="Somente Números" value="{{ old('document') ?? $client->document }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="11" maxlength="11">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
