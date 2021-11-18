@extends('layout')

@section('content')
    <h1>Visualizar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form class="" action="" method="post"
                  enctype="multipart/form-data">

                <h5>Informações do cliente</h5>
                <input type="hidden" type="text" id="cliente_id" name="cliente_id" value="{{ $venda->cliente_id }}"/>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $venda->clientesVenda->name }}" disabled>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $venda->clientesVenda->email }}" disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="99999999999" value="{{ $venda->clientesVenda->cpf }}" disabled>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <input type="hidden" type="text" id="produto_id" name="produto_id" value="{{ $venda->produto_id }}"/>
                    <label for="product">Produto</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $venda->produtosVenda->nome }}">
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" id="date" name="data" value="{{ $venda->data }}">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="text" class="form-control" id="quantity" name="quantidade" placeholder="1 a 10" value="{{ $venda->quantidade }}">
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control money" id="discount" name="desconto" placeholder="15,00" value="{{ $venda->desconto }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="1 a 10" value="{{ $venda->status }}">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
        });
    </script>
@endsection
