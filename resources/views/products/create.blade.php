@extends('layout')

@section('content')
    <h1>Adicionar Produto</h1>
        @if($errors->all())
            @foreach($errors->all() as $error)
                <x-message color="danger">
                <p class="icon-asterisk">{{$error}}</p>
                </x-message>
            @endforeach
        @endif
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <h5 class="card-title mb-5">Informações do Produto
                    <a href="{{ route('home') }}" class='btn btn-primary float-right btn-sm rounded-pill'><i class='fa fa-home'></i>  Home</a>
                    <a href="{{ route('sales.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a>
                </h5>
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control money" id="price" name="price" placeholder="100,00 ou maior" value="{{ old('price') }}">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
        <script>
            $(document).ready(function(){
                $('.money').mask('000.000.000.000.000,00', {reverse: true});
                
                $(".money").change(function(){
                    $("#value").html($(this).val().replace(/\D/g,''))
                })
            
            });
        </script>
@endsection
