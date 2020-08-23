@extends('layout')

@section('content')
    <h1>Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" id="idForm" action="/products/alterar" enctype="multipart/form-data" data-toggle="validator" role="form">
                @csrf
                <input id="idProduto" type="hidden" class="form-control" name="idProduto" value="{{ $produto['idProduto'] }}">
                <input id="blobImagemProduto" type="hidden" class="form-control" name="blobImagemProduto" value="{{ $produto['blobImagemProduto'] }}">

                <div class="form-group text-center">
                    <label for="foto"></label>
                    <img src="data:image/png;base64,{{ $produto['blobImagemProduto'] }}" id="fotoProduto" name="fotoProduto" width="200px" height="200px" alt="{{ $produto['nomeProduto'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ $produto['nomeProduto'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="description" name="description">{{ $produto['descricaoProduto'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="100,00 ou maior" value="{{ $produto['precoProduto'] ?? '' }}">
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
