@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName">
                                <option>Clientes</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                <tr>
                    <td>
                        Perfect Caps
                    </td>
                    <td>
                        20/07/2019 19h15
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nature Caps
                    </td>
                    <td>
                        20/07/2019 19h20
                    </td>
                    <td>
                        R$ 125,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Libid Caps
                    </td>
                    <td>
                        20/07/2019 19h45
                    </td>
                    <td>
                        R$ 110,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>
                <tr>
                    <td>
                        Vendidos
                    </td>
                    <td>
                        100
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                <tr>
                    <td>
                        Perfect Caps
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nature Caps
                    </td>
                    <td>
                        R$ 120,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Libid Caps
                    </td>
                    <td>
                        R$ 150,00
                    </td>
                    <td>
                        <a href='' class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
