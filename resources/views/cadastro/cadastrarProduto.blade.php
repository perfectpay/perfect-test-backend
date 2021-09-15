@extends('layout')
@section('content')
    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
         <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Nome">Nome do produto</label>
                    <input type="text" class="form-control " id="Nome" name = "Nome" value="{{old('nomeProduto')}}">
                </div>
                <div class="form-group">
                    <label for="Descricao">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" id="Descricao" name = "Descricao" >{{old('descricao')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="Preco">Preço</label>
                    <input type="text" onKeyUp="mascaraMoeda(this, event)" onkeypress="return onlynumber()" class="form-control" id="Preco" name = "Preco" value="{{old('preco')}}" placeholder="100,00 ou maior">
                    <br>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection


<?php 
    if(isset($erro))
    {
        phpAlert($erro);
    }

    function phpAlert($erro) {
        echo '<script type="text/javascript">alert("' . $erro . '")</script>';
    }
    
?>

<script>

    function onlynumber(evt) {
   var theEvent = evt || window.event;
   var key = theEvent.keyCode || theEvent.which;
   key = String.fromCharCode( key );
   //var regex = /^[0-9.,]+$/;
   var regex = /^[0-9.]+$/;
   if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
   }
     
}

String.prototype.reverse = function(){
  return this.split('').reverse().join(''); 
};

function mascaraMoeda(campo,evento){
  var tecla = (!evento) ? window.event.keyCode : evento.which;
  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
  var resultado  = "";
  var mascara = "##.###.###,##".reverse();
  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
    if (mascara.charAt(x) != '#') {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}
</script>