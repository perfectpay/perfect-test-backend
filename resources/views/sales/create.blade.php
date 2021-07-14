@extends('layout')

@section('content')
    <h1>Adicionar Venda</h1>
    @if($errors->all())
        @foreach($errors->all() as $error)
            <x-message color="danger">
            <p class="icon-asterisk">{{$error}}</p>
            </x-message>
        @endforeach
    @endif
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('sales.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <h5 class="card-title mb-5">Informações do cliente
                    <a href="{{ route('home') }}" class='btn btn-primary float-right btn-sm rounded-pill'><i class='fa fa-home'></i>  Home</a>
                    <a href="{{ route('clients.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo cliente</a>
                </h5>
                <div class="form-group">
                    <label for="name">Cliente</label>
                    <select id="name" name="client_id" class="form-control" required>
                        <option value="">Escolha...</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product_id" class="form-control" required>
                        <option selected value="">Escolha...</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="1 a 10" value="{{ old('quantity') }}" required>
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control money" id="discount" name="discount" placeholder="100,00 ou menor" value="{{ old('discount') }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option selected value="">Escolha...</option>
                        <option value="Aprovado" {{ old('status') === 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                        <option value="Cancelado" {{ old('status') === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        <option value="Devolvido" {{ old('status') === 'Devolvido' ? 'selected' : '' }}>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
        <script>
            $(document).ready(function() {
                $('#name').select2({tags: true});

                $('.money').mask('000.000.000.000.000,00', {reverse: true});
                
                $(".money").change(function(){
                    $("#value").html($(this).val().replace(/\D/g,''))
                })
            });
        </script>
@endsection
