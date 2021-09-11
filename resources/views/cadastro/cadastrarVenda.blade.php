@extends('layout')

@section('content')
    <h1>Adicionar / Editar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('storeVenda') }}" method="post">
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="nome">Nome do cliente</label>
                    <input type="text" class="form-control " id="nome" name = "nome" value="{{old('preco')}}" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name = "email" value="{{old('email')}}" >
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name = "cpf" value="{{old('cpf')}}" placeholder="99999999999">
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="idProduto">Produto</label>
                    <select id="idProduto" name = "idProduto" value="{{old('idProduto')}}"  class="form-control">
                        <option selected>Escolha...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="updated_at">Data</label>
                    <input type="text" class="form-control single_date_picker" id="updated_at" name = "updated_at" value="{{old('updated_at')}}" >
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="text" class="form-control" id="quantidade" name = "quantidade" value="{{old('quantidade')}}"  placeholder="1 a 10" >
                </div>
                <div class="form-group">
                    <label for="desconto">Desconto</label>
                    <input type="text" class="form-control" id="desconto" name = "desconto" value="{{old('desconto')}}" placeholder="100,00 ou menor" >
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name = "status" value="{{old('status')}}" class="form-control">
                        <option selected>Escolha...</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
