@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='/sales' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form action="/" method="get">
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" name="idCliente" id="inlineFormInputName">
                                <option value="" selected>Clientes</option>
                                @foreach ($clientes as $key => $valores )
                                    <option value="{{$valores->id}}">{{$valores->usuario_nome}}</option>
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
                            <input type="text" name="dateEntre" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
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
                @foreach ($vendas_query as $key => $valoresvendas)
                <tr>
                    <td>
                        {{$valoresvendas->produto_nome}}
                    </td>
                    <td>
                        {{date('d/m/Y', strtotime($valoresvendas->dataVenda))}}
                    </td>
                    <td>
                        R$ {{$valoresvendas->vendaValorTotal}}
                    </td>
                    <td>
                        <a href='{{ route('editar_venda',['id' => $valoresvendas->id, 'produtoId' => $valoresvendas->produtoId, 'usuarioId' => $valoresvendas->usuarioId] ) }}' class='btn btn-primary'>Editar</a>
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
                <tr>
                    <td>
                        Vendidos
                    </td>
                    <td>
                        {{$venda_aprovada->count()}}
                    </td>
                    <td>
                        R$ {{$venda_aprovada->sum('vendaValorTotal')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        {{$venda_cancelada->count()}}
                    </td>
                    <td>
                        R$ {{$venda_cancelada->sum('vendaValorTotal')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        {{$venda_devolvida->count()}}
                    </td>
                    <td>
                        R$ {{$venda_devolvida->sum('vendaValorTotal')}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='/products' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
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
                @foreach ($produtos as $key => $valores )
                <tr>
                    <td>
                        {{$valores->produto_nome}}
                    </td>
                    <td>
                        {{$valores->preco}}
                    </td>
                    <td>
                        <a href='{{route('editar_produto', ['id' => $valores->id])}}' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
