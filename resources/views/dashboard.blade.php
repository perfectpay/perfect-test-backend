@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href="{{ route('clients.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo cliente</a>
                <a href="{{ route('sales.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form action="{{ route('search') }}" method="post">
            @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName" name="client_id" required>
                                <option value="">Clientes</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" name="period" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            @if($period != null && $client_name != null)
               <b>10 Buscas mais recentes pelo cliente:</b> {{$client_name}} <b>no período entre</b> {{$period}}
            @endif
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
                @if($lastTenSales->count() > 0)
                    @foreach($lastTenSales as $ltsale)
                    <tr>
                        <td>
                            {{$ltsale->product->name}}
                        </td>
                        <td>
                            {{$ltsale->created_at}}
                        </td>
                        <td>
                            R$ {{ number_format($ltsale->total_purchase_amount, 2, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('sales.edit', ['sale' => $ltsale->id]) }}" class='btn btn-primary'>Editar</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>
                        Nenhum registro encontrado!
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
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
                        {{$sold}}
                    </td>
                    <td>
                        R$ {{number_format($amountSold, 2, ',', '.')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        {{$canceled}}
                    </td>
                    <td>
                        R$ {{number_format($amountCanceled, 2, ',', '.')}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        {{$returns}}
                    </td>
                    <td>
                        R$ {{number_format($amountReturns, 2, ',', '.')}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href="{{ route('products.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
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
                @if($lastTenSales->count() > 0)
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            R$ {{number_format($product->price, 2, ',', '.')}}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class='btn btn-primary'>Editar</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>
                        Nenhum registro encontrado!
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
