@extends('layout')

@section('content')
    <h1>Adicionar / Editar Venda</h1>
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

            <form class="" action="{{ route('venda.store') }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('POST')
                <h5>Informações do cliente</h5>
                <input type="hidden" type="text" id="cliente_id" name="cliente_id" value=""/>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <select class="form-control" id="clienteName" name="">
                        <option>Selecione</option>
                        @foreach($clientes as $cliente)
                            <option>{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="99999999999">
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <input type="hidden" type="text" id="produto_id" name="produto_id" value=""/>
                    <label for="product">Produto</label>
                    <select class="form-control" id="produtoName" name="">
                        <option>Selecione</option>
                        @foreach($produtos as $produto)
                            <option>{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" id="date" name="data">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="text" class="form-control" id="quantity" name="quantidade" placeholder="1 a 10">
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control money" id="discount" name="desconto" placeholder="15,00">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option selected>Escolha...</option>
                        <option>Aprovado</option>
                        <option>Cancelado</option>
                        <option>Devolvido</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            const _token = $('input[name="_token"]').val();

            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});

            $('#clienteName').change(function () {
                if ($(this).val() != '') {
                    var value = $(this).val();

                    $.ajax({
                        url: "{{ route('cliente.busca') }}",
                        method: "POST",
                        data: {value: value, _token: _token},
                        success: function (result) {
                            $('#cliente_id').val(result.id);
                            $('#email').val(result.email);
                            $('#cpf').val(result.cpf);
                        }
                    })
                }
            });

            $('#produtoName').change(function () {
                if ($(this).val() != '') {
                    var value = $(this).val();

                    $.ajax({
                        url: "{{ route('produto.busca') }}",
                        method: "POST",
                        data: {value: value, _token: _token},
                        success: function (result) {
                            $('#produto_id').val(result.id);
                        }
                    })
                }
            });

        });
    </script>
@endsection
