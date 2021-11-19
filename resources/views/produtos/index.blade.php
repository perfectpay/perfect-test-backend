@extends('layout')

@section('content')
    <h1>Lista de Produtos</h1><a class="btn btn-primary bi bi-plus-circle my-1" href="{{ route('produto.create') }}"> novo produto</a>
    <div class="container">
        @if(session()->exists('message'))
            <div class="message message-{{session()->get('color')}}">
                <p class="icon-asterisk">{{ session()->get('message') }}</p>
            </div>
        @endif
        <table id="lista" class="table table-sm table-responsive-md display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($produtos))
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->descricao}}</td>
                        <td>{{$produto->preco}}</td>
                        <td class="text-right">
                            <a class="bi bi-pencil mx-1" href="{{ route('produto.edit', ['id' => $produto->id]) }}"></a>
                            <a class="bi bi-eye mx-1" href="{{ route('produto.show', ['id' => $produto->id]) }}"></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#lista').DataTable( {

            } );
        });
    </script>
@endsection
