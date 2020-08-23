@extends('layout')

@section('title', 'Adicionar Produto')

@section('content')
<h1>Adicionar Produto</h1>

<div class='card'>
    <div class='card-body'>

        @include('components.alerts.status')

        <form method="POST" action="{{ route('products.store') }}">

            @csrf

            <div class="form-group">
                <label for="name">Nome do produto</label>
                <input type="text" class="form-control " name="name" id="name" required autofocus>
            </div>
            @include('components.forms.error-field', ['fieldName' => 'name'])

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea type="text" rows='5' class="form-control" name="description" id="description" required></textarea>
            </div>
            @include('components.forms.error-field', ['fieldName' => 'description'])

            <div class="form-group">
                <label for="price">Preço</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="100,00 ou maior" required>
            </div>
            @include('components.forms.error-field', ['fieldName' => 'price'])

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection
