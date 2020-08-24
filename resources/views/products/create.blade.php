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
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required autofocus
                >
            </div>
            @include('components.forms.error-field', ['fieldName' => 'name'])

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea
                    type="text"
                    rows='5'
                    class="form-control @error('description') is-invalid @enderror"
                    name="description"
                    id="description"
                    required
                >{{ old('description') }}</textarea>
            </div>
            @include('components.forms.error-field', ['fieldName' => 'description'])

            <div class="form-group">
                <label for="price">Preço</label>
                <input
                    type="number"
                    class="form-control @error('price') is-invalid @enderror"
                    name="price"
                    id="price"
                    placeholder="100,00 ou maior"
                    value="{{ old('price') }}"
                    required
                >
            </div>
            @include('components.forms.error-field', ['fieldName' => 'price'])

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection