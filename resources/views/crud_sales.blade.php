@extends('layout')

@section('content')
    <h1>Adicionar / Editar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            @if(Route::currentRouteName() == 'editar_venda') <!--Editar uma Venda----------------------------------------------------->
            <form action="{{ route('update_venda', ['id'=> $venda->id, 'produtoId' => $produto->id, 'usuarioId' => $usuario->id]) }}" method="post">
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" value="{{$usuario->usuario_nome}}" name="name" class="form-control " id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="{{$usuario->email}}" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" placeholder="exemplo@exemplo.com" id="email" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" value="{{$usuario->cpf}}" name="cpf" pattern="[0-9]{11}" class="form-control" id="cpf" placeholder="99999999999" required>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product" class="form-control" required>
                        <option value="" selected>Selecione</option>
                        @foreach ($produtos as $key => $valoresproduto )
                            <option value="{{$valoresproduto->id}}">{{$valoresproduto->produto_nome}} - R$ {{$valoresproduto->preco}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" value="{{date('d/m/Y', strtotime($venda->dataVenda))}}" name="date" class="form-control single_date_picker" id="date" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="number" value="{{$venda->quantidadeProduto}}" name="quantity" min="1" max="10" maxlenght="2" class="form-control" id="quantity" placeholder="1 a 10" required>
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="number" value="{{$venda->desconto}}" name="discount" min="0" max="100" maxlenght="3" class="form-control" id="discount" placeholder="100,00 ou menor" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="" selected>Selecione</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
            @elseif (Route::currentRouteName() == 'update_venda') <!-- RETORNO AO CADASTRAR nova venda------------------------------------->
            <form action="{{ route('registrar_venda') }}" method="post">
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" name="name" class="form-control " id="name" required disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" placeholder="exemplo@exemplo.com" id="email" required disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" pattern="[0-9]{11}" class="form-control" id="cpf" placeholder="99999999999" required disabled>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product" class="form-control" required disabled>
                        <option value="" selected>Selecione</option>
                            <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" name="date" class="form-control single_date_picker" id="date" required disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="number" name="quantity" min="1" max="10" maxlenght="2" class="form-control" id="quantity" placeholder="1 a 10" required disabled>
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="number" name="discount" min="0" max="100" maxlenght="3" class="form-control" id="discount" placeholder="100,00 ou menor" required disabled>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required disabled>
                        <option value="" selected>Selecione</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <div class="bg-success text-light text-center m-1 "><p>Venda Atualizada Com Sucesso</p></div>
                <button type="submit" class="btn btn-primary" disabled>Atualizar</button>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
            @elseif (Route::currentRouteName() == 'registrar_venda') <!--RETORNO NOVA VENDA CADASTRADO--------------------------------------->
            <form action="{{ route('registrar_venda') }}" method="post">
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" name="name" class="form-control " id="name" disabled required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" disabled placeholder="exemplo@exemplo.com" id="email" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" pattern="[0-9]{11}" class="form-control" id="cpf" placeholder="99999999999" required disabled>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product" class="form-control" required disabled>
                        <option value="" selected>Selecione</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" name="date" class="form-control single_date_picker" id="date" required disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="number" name="quantity" min="1" max="10" maxlenght="2" class="form-control" id="quantity" placeholder="1 a 10" required disabled>
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="number" name="discount" min="0" max="100" maxlenght="3" class="form-control" id="discount" placeholder="100,00 ou menor" required disabled>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required disabled>
                        <option value="" selected>Selecione</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <div class="bg-success text-light text-center m-1 "><p>Nova Venda Cadastrada Com Sucesso</p></div>
                <button type="submit" class="btn btn-primary">Salvar</button disabled>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
            @else <!--CADASTRAR NOVA VENDA-------------------------------------------------------------------------------------------------->
            </form>
            <form action="{{ route('registrar_venda') }}" method="post">
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" name="name" class="form-control " id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" placeholder="exemplo@exemplo.com" id="email" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" pattern="[0-9]{11}" class="form-control" id="cpf" placeholder="99999999999" required>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product" class="form-control" required>
                        <option value="" selected>Selecione</option>
                        @foreach ($produtos as $key => $valores )
                            <option value="{{$valores->id}}">{{$valores->produto_nome}} - R$ {{$valores->preco}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" name="date" class="form-control single_date_picker" id="date" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="number" name="quantity" min="1" max="10" maxlenght="2" class="form-control" id="quantity" placeholder="1 a 10" required>
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="number" name="discount" min="0" max="100" maxlenght="3" class="form-control" id="discount" placeholder="100,00 ou menor" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="" selected>Selecione</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="/" class="btn btn-outline-primary">Voltar</a>
            </form>
        </div>
    </div>
    @endif
@endsection
