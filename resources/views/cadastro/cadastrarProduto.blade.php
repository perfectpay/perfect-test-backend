@extends('layout')
@section('content')
    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
        <?php $URL = $_SERVER['PATH_INFO']; 
        $idVenda = preg_replace("/[^0-9]/","", $_SERVER['PATH_INFO']);
        $URL = preg_replace("/[^A-z]/","", $_SERVER['PATH_INFO']); /* dd($URL) */?>
        @if($URL == 'telaDoProduto')
         <form action="{{ route('store') }}" method="post">
        @endif
        @if($URL == 'editarProduto')
        <form action="{{ route('editarProduto/{<?php $IdProduto ?>}') }}" method="get">
       @endif
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do produto</label>
                    @if($URL == 'telaDoProduto')
                    <input type="text" class="form-control " id="nomeProduto" name = "nomeProduto" value="{{old('nomeProduto')}}">
                    @endif
                    @if($URL == 'editarProduto')
                    <input type="text" class="form-control " id="nomeProduto" name = "nomeProduto" value="<?php echo $resultado->Nome ?>">
                    @endif
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    @if($URL == 'telaDoProduto')
                    <textarea type="text" rows='5' class="form-control" id="descricao" name = "descricao" >{{old('descricao')}}</textarea>
                    @endif
                    @if($URL == 'editarProduto')
                    <textarea type="text" rows='5' class="form-control" id="descricao" name = "descricao" ><?php echo $resultado->Descricao ?></textarea>
                    @endif
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    @if($URL == 'telaDoProduto')
                    <input type="text" onKeyUp="mascaraMoeda(this, event)" onkeypress="return onlynumber()" class="form-control" id="preco" name = "preco" value="{{old('preco')}}" placeholder="100,00 ou maior">
                    @endif
                    @if($URL == 'editarProduto')
                    <input type="text" onKeyUp="mascaraMoeda(this, event)" onkeypress="return onlynumber()" class="form-control" id="preco" name = "preco" value="<?php echo $resultado->Preco ?>" placeholder="100,00 ou maior">
                    @endif
                    <br>
                    @if($URL == 'telaDoProduto')
                <button type="submit" class="btn btn-primary">Salvar</button>
                    @endif
                    @if($URL == 'editarProduto')
                    <a href='Edit/{"<?php echo $resultado->Id ?>"}' class='btn btn-primary'>Editar</a>
                        @endif
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