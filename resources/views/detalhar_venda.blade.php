@extends('layout')

@section('content')
    <h1>Editar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" id="idForm" action="/sales/alterar" enctype="multipart/form-data" role="form">
                @csrf
                <input id="idVenda" type="hidden" class="form-control" name="idVenda" value="{{ $venda['idVenda'] }}">
                <input id="idCliente" type="hidden" class="form-control" name="idCliente" value="{{ $cliente['idCliente'] }}">

                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ $cliente['nomeCliente'] }}" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $cliente['emailCliente'] }}" disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="99999999999" maxlength="11" value="{{ $cliente['cpfCliente'] }}" disabled>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product" class="form-control">
                        <option disabled>Escolha...</option>
                        @foreach($produtos as $produto)
                            <option value="{{ $produto['idProduto'] }}" @if($produto['idProduto'] == $venda['idProduto']) selected @endif>{{ $produto['nomeProduto'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" id="date" name="date" value="{{ $venda['dataVenda'] }}">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="1 a 10" value="{{ $venda['quantidadeVenda'] }}">
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control" id="discount" name="discount" placeholder="100,00 ou menor" value="{{ $venda['descontoVenda'] }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option disabled>Escolha...</option>
                        <option value="Aprovado" @if($venda['statusVenda'] == "Vendido") selected @endif>Aprovado</option>
                        <option value="Cancelado" @if($venda['statusVenda'] == "Cancelado") selected @endif>Cancelado</option>
                        <option value="Devolvido" @if($venda['statusVenda'] == "Devolvido") selected @endif>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
