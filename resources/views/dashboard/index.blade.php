@extends('layout')

@section('title', 'Dashboard de vendas')

@section('content')
<h1>Dashboard de vendas</h1>

@include('components.alerts.status')

<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Tabela de vendas
            <a
                href="{{ route('sales.create') }}"
                class='btn btn-secondary float-right btn-sm rounded-pill'
            ><i class='fa fa-plus'></i> Nova venda</a>
        </h5>

        <form action="{{ route('dashboard.search') }}" method="GET">
            @csrf

            <div class="form-row align-items-center">
                <div class="col-sm-12 my-1">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="col-sm-5 my-1">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Escolha</div>
                        </div>

                        <select class="form-control" id="client_id" name="client_id" required value="">
                            <option value="" disabled hidden selected>Escolha ...</option>
                            @forelse ($clients as $client)
                                <option
                                    value="{{ $client->id }}"
                                    {{ isset($clientId) && $clientId === $client->id ? 'selected': '' }}
                                >{{ $client->name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 my-1">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período</div>
                        </div>
                        <input
                            type="text"
                            class="form-control date_range"
                            name="date_range"
                            id="date_range"
                            value="{{ isset($dataRange) ? "{$dataRange[0]} - {$dataRange[1]}" : '' }}"
                        >
                    </div>

                </div>
                <div class="col-sm-1 my-1">
                    <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                        <i class='fa fa-search'></i>
                    </button>
                </div>
            </div>
        </form>

        <table class='table'>
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    @php
                        $saleTotalValue = $sale->product->price * $sale->qt_product;

                        if($sale->discount != 0) {
                            $saleTotalValue -= $saleTotalValue * ($sale->discount / 100);
                        }
                    @endphp
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ date('d/m/Y H\hi', strtotime($sale->sale_date)) }}</td>
                        <td>R$ {{ number_format($saleTotalValue, 2, ',', ' ') }}</td>
                        <td>
                            <a
                                href="{{ route('sales.edit', $sale->id) }}"
                                class='btn btn-sm btn-primary'
                                role="button"
                            >Editar</a>
                            <button
                                type="button"
                                class="btn btn-sm btn-danger btn-destroy"
                                data-url="{{ route('sales.destroy', $sale->id) }}"
                            >Excluir</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Não há registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Resultado de vendas</h5>
        <table class='table'>
            <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($saleStatus as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>R$ {{ number_format($item['totalValue'], 2, ',', ' ')  }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Não ha registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Produtos
            <a href="{{ route('products.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'>
                <i class='fa fa-plus'></i> Novo produto
            </a>
        </h5>
        <table class='table'>
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', ' ') }}</td>
                        <td>
                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class='btn btn-sm btn-primary'
                                role="button"
                            >Editar</a>
                            <button
                                type="button"
                                class="btn btn-sm btn-danger btn-destroy"
                                data-url="{{ route('products.destroy', $product->id) }}"
                            >Excluir</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Não há registros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', event => {
        const btnsDestroy = document.querySelectorAll('.btn-destroy');

        btnsDestroy.forEach(btn => {
            btn.addEventListener('click', event => {
                destroyItem(event.target.dataset.url);
            });
        });
    });

    function destroyItem(url) {
        if(confirm('Deseja realmente excluir este item?')) {
            const _token = '{{ csrf_token() }}';

            axios.delete(url, {
                data: { _token },
                headers: {
                    'Content-type': 'application/json',
                }
            })
                .then(response => {
                    if(response.status === 204) {
                        alert('Item excluído com sucesso');
                        location.reload();
                    } else {
                        throw new Error();
                    }
                })
                .catch(error => {
                    console.log(error)
                    alert('Ocorreu um erro ao realizar esta operação');
                })
        }
    }
</script>
@endpush
