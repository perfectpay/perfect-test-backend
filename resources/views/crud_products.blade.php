@extends('layout')

@section('content')
    <h1>Adicionar / Editar Produto</h1>
    @if (Route::currentRouteName() == 'editar_produto') <!--ATUALIZAR PRODUTO REGISTRADO----------------------------------------------->
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('update_produto', ['id' => $produto->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" value="{{$produto->produto_nome}}" name="name_product" class="form-control " id="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" rows='5' class="form-control" id="description" required>{{$produto->descricao}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                <input type="number" value="{{$produto->preco}}" name="price" min="100" class="form-control" id="price" placeholder="100,00 ou maior" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
        </div>
    </div>
    @elseif (Route::currentRouteName() == 'update_produto') <!--RETORNO PRODUTO ATUALIZADO COM SUCESSO----------------------------------->
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('registrar_produto') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" name="name_product" class="form-control " disabled id="name">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" rows='5' class="form-control" id="description" disabled required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                <input type="number" name="price" min="100" class="form-control" id="price" placeholder="100,00 ou maior" disabled required>
                </div>
                <div class="bg-success text-light text-center m-1 "><p>Produto Atualizado Com Sucesso</p></div>
                <button type="submit" class="btn btn-primary" disabled>Atualizar</button>
                <a href="/" class="btn btn-primary">Voltar</a>
            </form>
        </div>
    </div>
    @elseif (Route::currentRouteName() == 'registrar_produto') <!--RETORNO PRODUTO CADASTRADO----------------------------------------->
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('registrar_produto') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" name="name_product" class="form-control " id="name" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" rows='5' class="form-control" id="description" required disabled></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                <input type="number" name="price" min="100" class="form-control" id="price" placeholder="100,00 ou maior" required disabled>
                </div>
                <div class="bg-success text-light text-center m-1 "><p>Um Novo Produto foi Cadastrado Com Sucesso</p></div>
                <button type="submit" class="btn btn-primary" disabled>Salvar</button>
                <a href="/" class="btn btn-primary">Voltar</a>
            </form>
        </div>
    </div>
    @else <!--CADASTRAR NOVO PRODUTO--------------------------------------------------------------------------------------->
        <div class='card'>
        <div class='card-body'>
            <form action="{{ route('registrar_produto') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" name="name_product" class="form-control " id="name">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" rows='5' class="form-control" id="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                <input type="number" name="price" min="100" class="form-control" id="price" placeholder="100,00 ou maior" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
        </div>
    </div>
    @endif
@endsection