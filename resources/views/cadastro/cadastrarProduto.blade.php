@extends('layout')
@section('content')
    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do produto</label>
                    <input type="text" class="form-control " id="nomeProduto" name = "nomeProduto" value="{{old('nomeProduto')}}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="descricao" name = "descricao"></textarea>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="decimal" class="form-control" id="preco" name = "preco" value="{{old('preco')}}" placeholder="100,00 ou maior">
                <button type="submit" class="btn btn-sucess">Salvar</button>
            </form>
        </div>
    </div>
@endsection
