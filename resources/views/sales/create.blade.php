@extends('layout')

@section('title', 'Adicionar Venda')

@section('content')
    <h1>Adicionar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            @include('components.alerts.status')

            <form action="{{ route('sales.store') }}" method="POST">
                @csrf

                <fieldset>
                    <legend>Informações do cliente</legend>

                    <div class="form-group">
                        <label for="name">Nome do cliente</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
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
                            value="{{ old('email') }}"
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
                            value="{{ old('cpf') }}"
                            placeholder="99999999999"
                            required
                        >
                    </div>
                    @include('components.forms.error-field', ['fieldName' => 'cpf'])
                </fieldset>

                <fieldset class='mt-1'>
                    <legend>Informações da venda</legend>

                    <div class="form-group">
                        <label for="product_id">Produto</label>
                        <select
                            class="form-control @error('product_id') is-invalid @enderror"
                            name="product_id"
                            id="product_id"
                            required
                        >
                            <option
                                value=""
                                disabled
                                hidden
                                {{ old('product_id') === null ? 'selected' : '' }}
                            >Escolha ...</option>
                            @forelse ($products as $product)
                                <option
                                    value="{{ $product->id}}"
                                    {{ old('product_id') === $product->id ? 'selected' : '' }}
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
                            value="{{ old('sale_date') }}"
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
                            value="{{ old('qt_product') }}"
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
                            value="{{ old('discount') }}"
                            min="0"
                            max="100"
                            step="1"
                            required
                        >
                    </div>
                    @include('components.forms.error-field', ['fieldName' => 'discount'])

                    <div class="form-group">
                        <label for="status">Status</label>

                        <select
                            class="form-control @error('sale_status_id') is-invalid @enderror"
                            name="sale_status_id"
                            id="sale_status_id"
                            required
                        >
                            <option
                                value=""
                                disabled
                                hidden
                                {{ old('sale_status_id') === null ? 'selected' : '' }}
                            >Escolha ...</option>

                            @forelse ($saleStatus as $item)
                                <option
                                    value="{{ $item->id}}"
                                    {{ old('sale_status_id') === $item->id ? 'selected' : '' }}
                                >{{ $item->name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                    @include('components.forms.error-field', ['fieldName' => 'sale_status_id'])

                </fieldset>


                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
