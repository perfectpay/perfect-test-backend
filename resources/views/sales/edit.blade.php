@extends('layout')

@section('title', 'Alterar Venda')

@section('content')
<h1>Alterar Venda</h1>
<div class='card'>
    <div class='card-body'>
        @include('components.alerts.status')

        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf

            @method('PUT')

            <fieldset>
                <legend>Informações do cliente</legend>

                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        id="name"
                        value="{{ $sale->client->name ?? old('name') }}"
                        required autofocus
                    >
                </div>
                @include('components.forms.error-field', ['fieldName' => 'name'])

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        id="email"
                        value="{{ $sale->client->email ?? old('email') }}"
                        required
                    >
                </div>
                @include('components.forms.error-field', ['fieldName' => 'email'])

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input
                        type="text"
                        class="form-control @error('cpf') is-invalid @enderror"
                        name="cpf"
                        id="cpf"
                        minlength="11"
                        maxlength="11"
                        value="{{ $sale->client->cpf ?? old('cpf') }}"
                        placeholder="99999999999"
                        required>
                </div>
                @include('components.forms.error-field', ['fieldName' => 'cpf'])
            </fieldset>

            <fieldset class='mt-1'>
                <legend>Informações da venda</legend>

                <div class="form-group">
                    <label for="product_id">Produto</label>
                    <select class="form-control @error('product_id') is-invalid @enderror" name="product_id" id="product_id" required>
                        <option value="" disabled hidden >Escolha ...</option>

                        @forelse ($products as $product)
                            @php
                                $productSelected = false;

                                if($product->id === $sale->product->id) {
                                    $productSelected = true;
                                }

                                if(old('product_id') === $product->id) {
                                    $productSelected = true;
                                }
                            @endphp

                            <option
                                value="{{ $product->id }}"
                                {{ $productSelected ? 'selected' : '' }}
                            >{{ $product->name }}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                @include('components.forms.error-field', ['fieldName' => 'product_id'])

                <div class="form-group">
                    <label for="sale_date">Data</label>
                    <input
                        type="datetime-local"
                        class="form-control @error('sale_date') is-invalid @enderror"
                        name="sale_date"
                        id="sale_date"
                        value="{{ date('Y-m-d\TH:i:s', strtotime($sale->sale_date)) ?? old('sale_date') }}"
                    >
                </div>
                @include('components.forms.error-field', ['fieldName' => 'sale_date'])

                <div class="form-group">
                    <label for="qt_product">Quantidade</label>
                    <input
                        type="number"
                        class="form-control @error('qt_product') is-invalid @enderror"
                        name="qt_product"
                        id="qt_product"
                        placeholder="1 a 10"
                        min="1"
                        max="10"
                        step="1"
                        value="{{ $sale->qt_product ?? old('qt_product') }}"
                        required
                    >
                </div>
                @include('components.forms.error-field', ['fieldName' => 'qt_product'])

                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input
                        type="number"
                        class="form-control @error('discount') is-invalid @enderror"
                        name="discount"
                        id="discount"
                        placeholder="100 ou menor"
                        value="{{ $sale->discount ?? old('discount') }}"
                        min="0"
                        max="100"
                        step="1"
                        required
                    >
                </div>
                @include('components.forms.error-field', ['fieldName' => 'discount'])

                <div class="form-group">
                    <label for="status">Status</label>

                    <select class="form-control @error('sale_status_id') is-invalid @enderror" name="sale_status_id" id="sale_status_id" required>
                        <option value="" disabled hidden >Escolha ...</option>

                        @forelse ($saleStatus as $item)
                            @php
                                $saleStatusSelected = false;

                                if($product->id === $sale->product->id) {
                                    $saleStatusSelected = true;
                                }

                                if(old('product_id') === $product->id) {
                                    $saleStatusSelected = true;
                                }
                            @endphp
                            <option
                                value="{{ $item->id}}"
                                {{ $saleStatusSelected ? 'selected' : '' }}
                            >{{ $item->name }}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
                @include('components.forms.error-field', ['fieldName' => 'sale_status_id'])

            </fieldset>


            <button type="submit" class="btn btn-primary">Alterar</button>
        </form>
    </div>
</div>
@endsection
