@extends('layout')

@section('content')
    <h1>Lista de Cliente</h1>
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
                <th>Email</th>
                <th>Cpf</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($clientes))
                @foreach($clientes as $cliente)
                    <td>{{$cliente->name}}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{$cliente->cpf}}</td>
                    <td class="text-right">
                        <a class="bi bi-pencil mx-1" href="{{ route('cliente.edit', ['id' => $cliente->id]) }}"></a>
                        <a class="bi bi-eye mx-1" href="{{ route('cliente.show', ['id' => $cliente->id]) }}"></a>
                    </td>
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
