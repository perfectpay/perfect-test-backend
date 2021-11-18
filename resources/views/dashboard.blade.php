@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='{{ route('venda.create') }}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName">
                                <option>Clientes</option>
                                @foreach($clientes as $cliente)
                                    <option>{{ $cliente->name }}</option>
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
                <tbody>
                @if(!empty($vendas))
                    @foreach($vendas->take(5) as $venda)
                        <tr>
                            <td>{{$venda->produtosVenda->nome}}</td>
                            <td>{{$venda->data}}</td>
                            <td>{{'R$ '.$venda->quantidade * $venda->produtosVenda->preco}}</td>
                            <td>
                                <a href='{{ route('venda.edit', ['id'=>$venda->id]) }}' class='btn btn-primary'>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>

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
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @if(!empty($resultados))
                    @foreach($resultados as $resultado)
                        <tr>
                            <td>{{$resultado->status}}</td>
                            <td>{{$resultado->total}}</td>
                            <td>{{ 'R$ '.($vendas->where('status', $resultado->status)->sum('produtosVenda.preco') - $vendas->where('status', $resultado->status)->sum('desconto')) }}</td>
                            <td>
                                <a href='{{ route('venda.edit', ['id'=>$venda->id]) }}' class='btn btn-primary'>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='{{ route('produto.create') }}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
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
                @if(!empty($produtos))
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{$produto->nome}}</td>
                            <td>{{'R$ '.$produto->preco}}</td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{{ route('produto.edit', ['id' => $produto->id]) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
