@extends('layout')

@section('content')
    <h1>Editar Venda</h1>
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

            <form class="" action="{{ route('venda.update', ['id'=>$venda->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5>Informações do cliente</h5>
                <input type="hidden" type="text" id="cliente_id" name="cliente_id" value="{{ $venda->cliente_id }}"/>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ $venda->clientesVenda->name }}" disabled>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                           value="{{ $venda->clientesVenda->email }}" disabled>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="99999999999"
                           value="{{ $venda->clientesVenda->cpf }}" disabled>
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <input type="hidden" type="text" id="produto_id" name="produto_id"
                           value="{{ $venda->produto_id }}"/>
                    <label for="product">Produto</label>
                    <select class="form-control" id="produtoName" name="produto">
                        @foreach($produtos as $produto)
                            <option
                                value="{{$produto->nome}}" {{ (old('produto') == $produto->nome ? 'selected' : ($venda->produto_id == $produto->id ? 'selected' :'' )) }}>{{$produto->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" id="date" name="data"
                           value="{{ $venda->data }}">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="text" class="form-control" id="quantity" name="quantidade" placeholder="1 a 10"
                           value="{{ $venda->quantidade }}">
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control money" id="discount" name="desconto" placeholder="15,00"
                           value="{{ $venda->desconto }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option
                            value="Aprovado" {{ (old('status') == 'Aprovado' ? 'selected' : ($venda->status == 'Aprovado' ? 'selected' :'' )) }}>
                            Aprovado
                        </option>
                        <option
                            value="Cancelado" {{ (old('status') == 'Cancelado' ? 'selected' : ($venda->status == 'Cancelado' ? 'selected' :'' )) }}>
                            Cancelado
                        </option>
                        <option
                            value="Devolvido" {{ (old('status') == 'Devolvido' ? 'selected' : ($venda->status == 'Devolvido' ? 'selected' :'' )) }}>
                            Devolvido
                        </option>
                    </select>
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
                    <form action="{{route('venda.destroy', ['id'=>$venda->id])}}" method="post" class="">
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
        $(document).ready(function () {
            const _token = $('input[name="_token"]').val();

            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});

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
