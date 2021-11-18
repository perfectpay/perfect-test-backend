@extends('layout')

@section('content')
    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            @if($errors->all())
                @foreach($errors->all() as $error)
                    <div class="message message-orange">
                        <p class="icon-asterisk">{{ $error }}</p>
                    </div>
                @endforeach
            @endif

            @if(session()->exists('message'))
                <div class="message message-{{session()->get('color')}}">
                    <p class="icon-asterisk">{{ session()->get('message') }}</p>
                </div>
            @endif
            <form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="nome" name="nome" value="{{ old('nome') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="tel" class="form-control money" id="preco" name="preco" placeholder="100,00 ou maior">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
    </script>
@endsection
