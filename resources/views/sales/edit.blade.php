@extends('layout')

@section('content')
    <h1>Editar Venda</h1>
    @if($errors->all())
        @foreach($errors->all() as $error)
            <x-message color="danger">
            <p class="icon-asterisk">{{$error}}</p>
            </x-message>
        @endforeach
    @endif

    @if(session()->exists('message'))
        <x-message color="{{session()->get('color')}}">
            <p class="icon-asterisk">{{session()->get('message')}}</p>
        </x-message>
    @endif
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('sales.update', ['sale' => $sale->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <h5 style="color: #006B76">Informações do cliente</h5>
                <div class="form-group">
                    <label for="name" style="font-weight: bold">Nome do cliente: </label>
                    {{ $sale->client->name }}
                </div>
                <div class="form-group">
                    <label for="email" style="font-weight: bold">Email: </label>
                    {{ $sale->client->email }}
                </div>
                <div class="form-group">
                    <label for="cpf" style="font-weight: bold">CPF: </label>
                    {{ $sale->client->document }}
                </div>
                <h5 class='mt-5' style="color: #006B76">Informações da venda</h5>
                <div class="form-group">
                    <label for="product" style="font-weight: bold">Produto: </label>
                    {{ $sale->product->name }}
                </div>
                <div class="form-group">
                    <label for="date" style="font-weight: bold">Data: </label>
                    {{ $sale->created_at }}
                </div>
                <div class="form-group">
                    <label for="date" style="font-weight: bold">Valor do produto: </label>
                    R$ {{ number_format($sale->product_price, 2, ',', '.') }}
                </div>
                <div class="form-group">
                    <label for="quantity" style="font-weight: bold">Quantidade: </label>
                    {{ $sale->quantity }}
                </div>
                <div class="form-group">
                    <label for="discount" style="font-weight: bold">Desconto: </label>
                    R$ {{ number_format($sale->discount, 2, ',', '.') }}
                </div>
                <div class="form-group">
                    <label for="date" style="font-weight: bold">Valor Total da compra: </label>
                    R$ {{ number_format($sale->total_purchase_amount, 2, ',', '.') }}
                </div>
                <div class="form-group">
                    <label for="status" style="font-weight: bold">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="">Escolha...</option>
                        <option value="Aprovado" {{ (old('status') == 'Aprovado' ? 'selected' : ($sale->status == 'Aprovado' ? 'selected' : '')) }}>Aprovado</option>
                        <option value="Cancelado" {{ (old('status') == 'Cancelado' ? 'selected' : ($sale->status == 'Cancelado' ? 'selected' : '')) }}>Cancelado</option>
                        <option value="Devolvido" {{ (old('status') == 'Devolvido' ? 'selected' : ($sale->status == 'Devolvido' ? 'selected' : '')) }}>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </form>
        </div>
    </div>
@endsection
