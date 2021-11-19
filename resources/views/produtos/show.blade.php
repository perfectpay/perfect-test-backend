@extends('layout')

@section('content')
    <h1>Visualizar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="nome" name="nome" value="{{ $produto->nome }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="descricao" name="descricao">{{ $produto->descricao}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="tel" class="form-control money" id="preco" name="preco" placeholder="100,00 ou maior" value="{{ $produto->preco }}">
                </div>
                <div class="">
                    @foreach($produto->imagesProduto as $image)
                        <img src="{{ url('storage/'.$image->path) }}" class="rounded" alt="...">
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
    </script>
@endsection
