@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='/sales/cadastrar' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName">
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente['idCliente'] }}">{{ $cliente['nomeCliente'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @foreach($vendas as $venda)
                    <tr>
                        <td>
                            {{ $venda['nomeProduto'] }}
                        </td>
                        <td>
                            {{ $venda['dataVenda'] }}
                        </td>
                        <td>
                            {{ $venda['valorVenda'] }}
                        </td>
                        <td>
                            <a href='/sales/detalhar/{{ $venda['idVenda'] }}' class='btn btn-primary'>Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>
                @foreach($relatorioVendas as $relatorio)
                    <tr>
                        <td>
                            {{ $relatorio['status'] }}
                        </td>
                        <td>
                            {{ $relatorio['quantidadeVendas'] }}
                        </td>
                        <td>
                            {{ $relatorio['somaValores'] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='/products/cadastrar' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @foreach($produtos as $produto)
                    <tr>
                        <td>
                            {{ $produto['nomeProduto'] }}
                        </td>
                        <td>
                            {{ $produto['precoProduto'] }}
                        </td>
                        <td>
                            <a href="/products/detalhar/{{ $produto['idProduto'] }}" class='btn btn-primary'>Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
