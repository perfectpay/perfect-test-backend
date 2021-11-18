@extends('layout')

@section('content')
    <h1>Editar Produto</h1>
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
            <form action="{{ route('produto.update', ['id'=>$produto->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " id="nome" name="nome" value="{{ old('nome') ?? $produto->nome }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="descricao" name="descricao">{{ old('descricao') ?? $produto->descricao }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="tel" class="form-control money" id="preco" name="preco" placeholder="100,00 ou maior" value="{{ old('preco') ?? $produto->preco }}">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" id="myModal" class="btn btn-danger bi-trash"
                        data-toggle="modal"
                        data-target="#deleteModal">Deletar
                </button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="deleteModalLabel">Deletar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Tem certeza que deseja excluir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('produto.destroy', ['id'=>$produto->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger bi-trash">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
    </script>
@endsection
