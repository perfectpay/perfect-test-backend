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

    <h1>Dashboard de Vendas</h1>
    <a href="{{ route('site.orders')}}">Voltar</a>
    <div class='card mt-3'>
        <div class='card-body'>
        	@if(isset($order))
        	<h5 class="card-title mb-5">Editar Pedido de Compra </h5>
        	@else
            <h5 class="card-title mb-5">Novo Pedido de Compra</h5>
            @endif  

@if(isset($order))
<form class="edit_client" action="" method = "post">
	@method('PUT')

	<div class="form-group">
    <label for="inputname">ID</label>
    <input class="form-control" name="id" id="InputID" hidden value = "{{$order->id ?? ''}}">
    <input class="form-control" name="id" id="InputID" disabled value = "{{$order->id ?? ''}}">
  </div>

@else
<form class="send_client" action="{{ route('site.order.create')}}" method = "post">
	
@endif 
@csrf
	<div class="form-group">
    <label for="inputname">Cliente</label>
        <select name="costumer_id" id="costumer_id" class="form-control" onchange="myFunction()">
                        <option @if(isset($order)) @else selected @endif value="0">Escolha...</option>
                        @foreach($costumers as $costumer)
                        <option  @if(isset($order)) @if($costumer->id==$order->costumer_id) selected @endif @endif value= "{{$costumer->id}}" >{{$costumer->name}}</option>
                        @endforeach
                    </select>
  </div>
  <p id="demo"></p>
  <div class="form-group">
    <label for="inputemail">Email address</label>
    <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Email" value = "@if(isset($order)){{$costumer->find($order->costumer_id)->email ?? ''}}@endif" disabled="">
    
  </div>

    <div class="form-group">
    <label for="inputcpf">CPF</label>
    <input class="form-control" name="cpf" id="InputCPF" placeholder="000.000.000-00" onkeyup="mascara_cpf()" maxlength="14" value = "@if(isset($order)){{$costumer->find($order->costumer_id)->cpf}} @endif" disabled>

  </div>

<h5 class="card-title mb-5">Informações do Pedido</h5>

    <div class="form-group">
    <label for="inputname">Data</label>
    <input class="form-control single_date_picker" name="order_date" id="date">
  </div>

    <div class="form-group">
    <label for="inputname">Produto</label>
    <select name="product_id" id="product_id" class="form-control">
                        <option value="0">Escolha...</option>
                        @foreach($products as $product)
                        <option @if(isset($order)) @if($product->id==$order->product_id) selected @endif @endif value = "{{$product->id}}" >{{$product->name}}</option>
                        @endforeach
                    </select>
  </div>

    <div class="form-group">
    <label for="inputname">Quantidade</label>
    <input class="form-control" name="quantity" id="InputName" aria-describedby="emailHelp" placeholder="1 a 10" value = "{{$order->quantity ?? ''}}">
  </div>

      <div class="form-group">
    <label for="inputname">Desconto</label>
    <input class="form-control" name="discount" id="InputDiscount" aria-describedby="emailHelp" placeholder="100.00 ou menor" value = "{{$order->discount ?? ''}}">
  </div>

      <div class="form-group">
    <label for="inputname">Status</label>
              <select name="status" id="status" class="form-control">
                        <option value="0" @if(isset($order)) @else selected @endif >Escolha...</option>
                        <option @if(isset($order)) @if($order->status=="Aprovado") selected @endif @endif value = "Aprovado">Aprovado</option>
                        <option @if(isset($order)) @if($order->status=="Cancelado") selected @endif @endif value = "Cancelado">Cancelado</option>
                        <option @if(isset($order)) @if($order->status=="Devolvido") selected @endif @endif value = "Devolvido">Devolvido</option>
                    </select>
  </div>

@if(isset($order))
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-pencil'></i>  Editar Pedido</button>
@else
<button type="submit" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo Pedido</button>
@endif
</form>
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
function myFunction() {

var app = @json($selected_costumer=$costumers->all());
  document.getElementById('InputEmail').value = app[document.getElementById('costumer_id').value].email;
  document.getElementById("InputCPF").value = app[document.getElementById('costumer_id').value].cpf;
}
</script>
@endsection