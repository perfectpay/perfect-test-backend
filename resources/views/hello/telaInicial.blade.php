@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='telaDeVenda' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
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
                <?php    
                   
                    $tamanhoVenda = count($vendas); 
                    $tamanhoProduto = count($produtos); 
                   for($i = 0; $i < $tamanhoVenda; $i++)
                         {
                    
                    echo"<tr>";
                        echo"<td>";
                            for($y = 0; $y < $tamanhoProduto; $y++)
                            {
                                for($z = 0; $z < $tamanhoVenda; $z++)
                                {
                                    if($produtos[$y]->Id == $vendas[$i]->IdProduto)
                                    {
                                        
                                        $nome = $produtos[$y]->Nome;
                                        $descricao = $produtos[$y]->Descricao;
                                        $preco = $produtos[$y]->Preco;
                                    }
                                }
                            }

                            echo $nome; echo " "; echo $descricao;
                        echo"</td> <td>";
                             echo $vendas[$i]->created_at; 
                        echo"</td> <td>";
                            $qtd = $vendas[$i]->Quantidade;
                            $desconto = $vendas[$i]->Desconto;
                             echo "R$"; echo $preco * $qtd - $desconto; 
                        echo"</td><td>";
                            echo "<a href='' class='btn btn-primary'>Editar</a>";
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
                                        $precoTotal += $produtos[$o]->Preco - $desc;//$precoTotal += $produtos[$o]->Preco;
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
                    
                    echo"<tr>";
                        echo"<td>";
                            echo $produtos[$i]->Nome; echo " "; echo $produtos[$i]->Descricao; 
                        echo"</td>";
                        echo"<td>";
                             echo $produtos[$i]->created_at; 
                        echo"</td>";
                        echo"<td>";
                             echo "R$"; echo $produtos[$i]->Preco; 
                        echo"</td>";
                        echo"<td>";
                            echo "<a href='' class='btn btn-primary'>Editar</a>";
                        echo"</td>";
                    echo"</tr>";

                         } ?>
            </table>
        </div>
    </div>
@endsection
