@extends('layout')

@section('content')
    <h1>Cliente</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="" method="post" enctype="multipart/form-data">
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ $cliente->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="exemple@exemple.com" value="{{ $cliente->email }}">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="99999999999" value="{{ $cliente->cpf }}">
                </div>
            </form>
        </div>
    </div>

    <h2>Últimas vendas</h2>
    <table id="lista" class="table table-sm table-responsive-md display nowrap" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Quant.</th>
            <th scope="col">Desc.</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($cliente->vendasCliente))
            @foreach($cliente->vendasCliente as $venda)
            <tr>
                <td>{{ $venda->data }}</td>
                <td>{{ $venda->quantidade }}</td>
                <td>{{ $venda->desconto }}</td>
                <td>{{ $venda->status }}</td>
                <td class="text-right">
                    <a class="bi bi-pencil mx-1" href="{{ route('venda.edit', ['id' => $venda->id]) }}"></a>
                    <a class="bi bi-eye mx-1" href="{{ route('venda.show', ['id' => $venda->id]) }}"></a>
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#lista').DataTable( {

            } );
        });
    </script>
@endsection
