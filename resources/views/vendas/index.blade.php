@extends('layout')

@section('content')
    <h1>Lista de Vendas</h1><a class="btn btn-primary bi bi-plus-circle my-1" href="{{ route('venda.create') }}"> nova venda</a>
    <div class="container">
        @if(session()->exists('message'))
            <div class="message message-{{session()->get('color')}}">
                <p class="icon-asterisk">{{ session()->get('message') }}</p>
            </div>
        @endif
        <table id="lista" class="table table-sm table-responsive-md display nowrap" style="width:100%">
            <thead>
            <tr>
                <th>Data</th>
                <th>Produto</th>
                <th>Quant.</th>
                <th>Desc.</th>
                <th>Status</th>
                <th>Cliente</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($vendas))
                @foreach($vendas as $venda)
                    <tr>
                        <td>{{$venda->data}}</td>
                        <td>{{$venda->produtosVenda->nome}}</td>
                        <td>{{$venda->quantidade}}</td>
                        <td>{{$venda->desconto}}</td>
                        <td>{{$venda->status}}</td>
                        <td>{{$venda->clientesVenda->name}}</td>
                        <td class="text-right">
                            <a class="bi bi-pencil mx-1" href="{{ route('venda.edit', ['id' => $venda->id]) }}"></a>
                            <a class="bi bi-eye mx-1" href="{{ route('venda.show', ['id' => $venda->id]) }}"></a>
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
