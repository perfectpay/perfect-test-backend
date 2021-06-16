@extends('layouts.layout')

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="row">
<div class="col-md-5 mr-auto">
<form class="contact__form" action="{{ route('site.contact.form')}}" method = "post">
  @csrf
  <div class="form-group">
    <label for="contactInput1">Nome</label>
    <input type="name" name="name" class="form-control" id="contactInput1" placeholder="Nome Completo">
  </div>

    <div class="form-group">
    <label for="contactInput2">Email</label>
    <input type="email" name="email" class="form-control" id="contactInput2" placeholder="name@example.com">
  </div>
  
  <div class="form-group">
    <label for="contactTextArea1">Mensagem</label>
    <textarea class="form-control" name="message" id="contactTextArea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
<div class="col-md-5 mr-auto">
<h2>Envie Sua Mensagem</h2>
<p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita illum iusto, aut repellat fuga!</p>
<ul class="list-unstyled pl-md-5 mb-5">
<li class="d-flex text-black mb-2">
<span class="mr-3"><span class="icon-map"></span></span> Rua, Cidade - Estado, <br> Pais
</li>
<li class="d-flex text-black mb-2"><span class="mr-3"><span class="icon-phone"></span></span> <span class="glyphicon glyphicon-search" aria-hidden="true"></span>(21) 98544-5545</li>
<li class="d-flex text-black"><span class="mr-3"><span class="icon-envelope-o"></span></span> email@perfectpay.com </li>
</ul>
</div>
</div>
@endsection