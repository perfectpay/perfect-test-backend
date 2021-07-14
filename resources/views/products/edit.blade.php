@extends('layout')

@section('content')
    <h1>Editar Produto</h1>
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
            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ old('name') ?? $product->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="description" name="description">{{ old('description') ?? $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control money" id="price" name="price" placeholder="100,00 ou maior" value="{{ old('price') ?? $product->price }}">
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