@extends('layouts.layout')

@section('content')
@if(Session::has('errors'))
@php($errors = Session::get('errors')->getMessageBag())

@foreach ($errors->all() as $error)
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ $error }}</p>
 @endforeach
@endif

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@if(Session::has('messagewarn'))
<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('messagewarn') }}</p>
@endif

    <h1>Dashboard de Vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Vendas
                <a href="{{route('site.order.create')}}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova Venda</a></h5>
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
                        ID
                    </th>
                    <th scope="col">
                        Cliente
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Desconto
                    </th>
                    <th scope="col">
                        Total
                    </th>
                    <th scope="col">
                        Ação
                    </th>
                </tr>
                @foreach($orders as $order)
                <tr>
                    <td>
                        {{$order->id}}
                    </td>
                    <td>
                        <a href="{{route('site.costumer.edit',['costumer'=>$order->costumer_id])}}">{{$costumers->where('id', $order->costumer_id)->first()['name']}}</a>

                    </td>
                     <td>
                        {{$order->order_date}}
                    </td>
                    <td>
                       <a href="{{route('site.product.edit',['product'=>$order->product_id])}}">{{$products->where('id', $order->product_id)->first()['name']}}</a>
                    </td>    
                    <td>
                        {{$order->quantity}}
                    </td>     
                    <td>
                        {{$order->status}}
                    </td> 
                    <td>
                        @if(isset($order->discount)) R$ {{$order->discount}} @endif
                    </td>         
                    <td>
                        @php($product_price = $products->where('id', $order->product_id)->first()['price'])
                        R$ {{($product_price * $order->quantity) - $order->discount}}</a>
                    </td>     
                    <td>
                    	<div class="acao dash-cliente">
                        <a href="{{route('site.order.edit',['order'=>$order])}}" class="btn btn-info btn-sm" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{route('site.order.delete',['order'=>$order])}}" class='btn btn-danger btn-sm' title="Deletar"  onclick="return confirm('Tem Certeza que deseja apagar este cliente?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                    </td>
                </tr>

               @endforeach
               
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
                       {{$orders->where('status','Aprovado')->count()}}
                    </td>
                    <td>
                        @php($total=0)
                        @foreach($orders->where('status','Aprovado') as $order)
                        @php($total = $total + ($products->where('id', $order->product_id)->first()->price * $order->quantity - $order->discount))
                        @endforeach
                        R$ {{$total}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        {{$orders->where('status','Cancelado')->count()}}
                    </td>
                    <td>
                    	@php($total=0)
                        @foreach($orders->where('status','Cancelado') as $order)
                        @php($total = $total + ($products->where('id', $order->product_id)->first()->price * $order->quantity - $order->discount))
                        @endforeach
                        R$ {{$total}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                       {{$orders->where('status','Devolvido')->count()}}
                    </td>
                    <td>
                        @php($total=0)
                        @foreach($orders->where('status','Devolvido') as $order)
                        @php($total = $total + ($products->where('id', $order->product_id)->first()->price * $order->quantity - $order->discount))
                        @endforeach
                        R$ {{$total}}
                    </td>
                </tr>
            </table>
        </div>
    </div>


@endsection

