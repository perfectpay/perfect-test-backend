@extends('layout')

@section('content')

    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <?php 
               
                if(isset($_SERVER['PATH_INFO']) )
                {
                    $URL = "";
                    $URL = $_SERVER['PATH_INFO'];
                    $idVenda = preg_replace("/[^0-9]/","", $_SERVER['PATH_INFO']);
                    $URL = preg_replace("/[^A-z]/","", $_SERVER['PATH_INFO']); 

                }
                if(isset($_SERVER['PHP_SELF'])) 
                {
                    $URL = "";
                    $URL = $_SERVER['PHP_SELF'];
                    $idVenda = preg_replace("/[^0-9]/","", $_SERVER['PHP_SELF']);
                    $URL = preg_replace("/[^A-z]/","", $_SERVER['PHP_SELF']); 
                }
          ?>
                <a href='telaDeVenda' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form action="{{ route('pesquisa') }}" method="get"> 
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select name="inlineFormInputName" class="form-control" id="inlineFormInputName">
                            <?php 
                                     $print = "";
                                     $print2 = "";
                                     $z = 0;
                                     $array = array();
                                     $array2 = array();
                                      
                                     $tamanhoVendas = count($vendas);
                              ?> @if($URL == 'indexphp') <?php 
                                    for($o = 0; $o < $tamanhoVendas; $o++)
                                    {
                                        if($o == 0)
                                        {
                                        $nomeAtual = $vendas[0]->Nome;          
                                        array_push($array, $nomeAtual);
                                        }
                                        for($i = 1; $i < $tamanhoVendas;$i++)
                                        {
                                            $tamanhoArray = count($array);
                                            $nomeAtual = $vendas[$i]->Nome; 
                                            if(!in_array($nomeAtual, $array))
                                            {        
                                            array_push($array, $nomeAtual);
                                            
                                            }  
                                           
                                        }
                                                              
                                    }
                                    $tamanhoResposta = count($array);
                                    for($i = 0; $i < $tamanhoResposta; $i++ )
                                    {
                                        $print = $array[$i];
                                        ?> <option id="<?php $i;?>"> <?php echo $print ?></option> <?php                                                      
                                    }        
                                       
                            ?>      @endif
                            
                            @if($URL == 'indexphppesquisa') <?php 
                            $tamanhoVendas = count($todasVendas);
                            for($o = 0; $o < $tamanhoVendas; $o++)
                            {
                                if($o == 0)
                                {
                                $nomeAtual = $todasVendas[0]->Nome;          
                                array_push($array, $nomeAtual);
                                }
                                for($i = 1; $i < $tamanhoVendas;$i++)
                                {
                                    $tamanhoArray = count($array);
                                    $nomeAtual = $todasVendas[$i]->Nome; 
                                    if(!in_array($nomeAtual, $array))
                                    {        
                                    array_push($array, $nomeAtual);
                                    
                                    }  
                                   
                                }
                                                      
                            }
                            $tamanhoResposta = count($array);
                            for($i = 0; $i < $tamanhoResposta; $i++ )
                            {
                                $print = $array[$i];
                                ?> <option id="<?php $i;?>"> <?php echo $print ?></option> <?php                                                      
                            }        
                               
                    ?>      @endif
                    
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username" name='datas'>
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
                <?php    
                   
                    $tamanhoVenda = count($vendas); 
                    $tamanhoProduto = count($produtos); 
                   for($i = 0; $i < $tamanhoVenda; $i++)
                         {
                    
                    echo"<tr>";
                        echo "<td>";
                            for($y = 0; $y < $tamanhoProduto; $y++)
                            {
                                for($z = 0; $z < $tamanhoVenda; $z++)
                                {
                                    if($produtos[$y]->Id == $vendas[$i]->IdProduto)
                                    {
                                        
                                        $imagem = $produtos[$y]->Imagem;
                                    } 
                                    
                                }
                            }
                            if(!empty($imagem))
                            {
                        
                            ?><img class='rounded-pill' src="{{ asset('storage/'.$imagem) }}" width='40' height='40' > 
                    <?php   }
                            

                        echo "</td>";
                        echo"<td>";
                            for($y = 0; $y < $tamanhoProduto; $y++)
                            {
                                for($z = 0; $z < $tamanhoVenda; $z++)
                                {
                                    if($produtos[$y]->Id == $vendas[$i]->IdProduto)
                                    {
                                        
                                        $nome = $produtos[$y]->Nome;
                                        $descricao = $produtos[$y]->Descricao;
                                        $preco = intval($produtos[$y]->Preco);
                                    }
                                    
                                }
                            }
                            
                            echo $nome; echo " "; echo $descricao;
                        echo"</td> <td>";
                             echo $vendas[$i]->created_at; 
                        echo"</td> <td>";
                            $qtd = intval($vendas[$i]->Quantidade);
                            $desconto = intval($vendas[$i]->Desconto);
                             echo "R$"; echo $preco * $qtd - $desconto;  
                        echo"</td><td>";
                            $id = $vendas[$i]->Id;
                            ?>
                           <a href='{{route('venda.detalheVenda', $id)}}' class='btn btn-primary'>Editar</a>
                           <?php
                            echo "</td></tr>";

                         } ?>
                
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
                <?php
                echo "<tr><td>";
                        echo "Vendidos";
                    echo "</td><td>";
                        
                    $tamanhoVenda = count($vendas); 
                    $tamanhoProduto = count($produtos); 
                    $qtd = 0;
                    $precoTotal = 0;
                    $desc = 0;
                   for($i = 0; $i < $tamanhoVenda; $i++)
                    {    
                        if($vendas[$i]->Status == "Aprovado")
                        {                        
                            $qtd++;                          
                        }
                    }
                         echo $qtd;
                    echo "</td><td>";
                        $tamanhoVenda = count($vendas); 
                        $tamanhoProduto = count($produtos); 
                        $qtd = 0;
                        $precoTotal = 0;
                        $desc = 0;
                        for($i = 0; $i < $tamanhoVenda; $i++)
                        {
                                
                             if($vendas[$i]->Status == "Aprovado")
                             {
                                $idProduto = $vendas[$i]->IdProduto;
                                $qtd = intval($vendas[$i]->Quantidade);
                                
                                for($o = 0; $o < $tamanhoProduto; $o++)
                                {
                                    if($idProduto == $produtos[$o]->Id)
                                    {
                                      
                                         $precoTotal += (intval($produtos[$o]->Preco) * $qtd);
                                         $desc += intval($vendas[$i]->Desconto);
                                    }
                                    
                                }
                               
                               
                             }


                         }
                        echo "R$"; echo $precoTotal - $desc;
                    echo "</td></tr>";
 
                echo "<tr><td>";
                        echo "Cancelados";
                    echo "</td><td>";
                            
                    $tamanhoVenda = count($vendas); 
                    $tamanhoProduto = count($produtos); 
                    $qtd = 0;
                    $precoTotal = 0;
                    $desc = 0;
                   for($i = 0; $i < $tamanhoVenda; $i++)
                         {
                                
                             if($vendas[$i]->Status == "Cancelado")
                             {
                                
                                $qtd++;
                               
                             }
                         }
                         echo $qtd;
                    echo "</td> <td>";
                        $tamanhoVenda = count($vendas); 
                        $tamanhoProduto = count($produtos); 
                        $qtd = 0;
                        $precoTotal = 0;
                        $desc = 0;
                        for($i = 0; $i < $tamanhoVenda; $i++)
                        {
                                
                             if($vendas[$i]->Status == "Cancelado")
                             {
                                $idProduto = $vendas[$i]->IdProduto;
                                $qtd = $vendas[$i]->Quantidade;
                                $desc = $vendas[$i]->Desconto;
                                for($o = 0; $o < $tamanhoProduto; $o++)
                                {
                                    if($idProduto == $produtos[$o]->Id)
                                    {
                                        $precoTotal += $produtos[$o]->Preco - $desc;
                                    }
                                }
                               
                               
                             }
                         }
                        echo "R$"; echo $precoTotal;
                    echo "</td></tr>";
                echo "<tr><td>";
                        echo "Devoluções";
                    echo "</td><td>";
                        $tamanhoVenda = count($vendas); 
                        $tamanhoProduto = count($produtos); 
                        $qtd = 0;
                        $precoTotal = 0;
                        $desc = 0;
                   for($i = 0; $i < $tamanhoVenda; $i++)
                         {
                                
                             if($vendas[$i]->Status == "Devolvido")
                             {
                                
                                $qtd++;
                               
                             }
                         }
                         echo $qtd;
                    echo "</td><td>";
                        $tamanhoVenda = count($vendas); 
                        $tamanhoProduto = count($produtos); 
                        $qtd = 0;
                        $precoTotal = 0;
                        $desc = 0;
                        for($i = 0; $i < $tamanhoVenda; $i++)
                        {
                                
                             if($vendas[$i]->Status == "Devolvido")
                             {
                                $idProduto = $vendas[$i]->IdProduto;
                                $qtd = $vendas[$i]->Quantidade;
                                $desc = $vendas[$i]->Desconto;
                                for($o = 0; $o < $tamanhoProduto; $o++)
                                {
                                    if($idProduto == $produtos[$o]->Id)
                                    {
                                        $precoTotal += $produtos[$o]->Preco - $desc;//$precoTotal += $produtos[$o]->Preco;
                                    }
                                }
                               
                               
                             }
                         }
                        echo "R$"; echo $precoTotal;
                    echo "</td></tr>";
                ?>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='telaDoProduto' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Nome
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
                <?php    
                   
                    $tamanho = count($produtos); 
                   for($i = 0; $i < $tamanho; $i++)
                         {
                        
                         $imagem = $produtos[$i]->Imagem; 
                        
                        ?>
                        <tr>
                        <td>
                            <?php if(!empty($imagem))
                            {
                        
                            ?><img class='rounded-pill' src="{{ asset('storage/'.$imagem) }}" width='40' height='40' > 
                    <?php   }?>
                            
                            <td>
                            <?php
                            echo $produtos[$i]->Nome; echo " "; echo $produtos[$i]->Descricao; 
                        echo"</td>";
                        echo"<td>";
                             echo $produtos[$i]->created_at; 
                        echo"</td>";
                        echo"<td>";
                             echo "R$"; echo $produtos[$i]->Preco; 
                        echo"</td>";
                        echo"<td>";
                            $IdProduto = $produtos[$i]->Id;
                           ?> 
                       </td>
                       <td><a href='{{route('produto.detalheProduto', $IdProduto)}}' class='btn btn-primary'> Editar </a> </td> 
                       <td><a href='{{route('produto.deletarProduto', $IdProduto)}}' class='btn btn-primary'> Excluir </a></td> 
                    </tr>
<?php
                         } ?>
            </table>
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
