@extends('layout')

@section('content')
    <h1>Adicionar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" id="idForm" action="/products/cadastrar" enctype="multipart/form-data" role="form">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control" id="price" placeholder="100,00 ou maior" name="price">
                </div>
                <div class="form-group">
                    <label for="file">Foto do produto</label>
                    <input type="file" class="form-control" name="file[]" id="file">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
