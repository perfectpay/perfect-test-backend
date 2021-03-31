@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas 
                <button onclick="modalSale('')" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</button></h5>
            <form id="form-filtersales">
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="cbClients" name="sale_client_id">
                              {{-- DADOS VIA AJAX --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="dateSales" name="dateSales">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button onclick="listSales()" type="button" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table' id="table-sales">
                <thead>
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
                </thead>
                <tbody>
                    <tr><td colspan="4"><i>Selecione um cliente para visualizar</i></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
          <div id="msgresult"></div>

            <table class='table' id="table-result">
               <thead>
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
               </thead>
               <tbody> 
              {{-- DADOS VIA AJAX --}}
               </tbody>
            </table>
        </div>
    </div>

<div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <button onclick="modalProduct()" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</button></h5>
            <table class='table' id="table-products">
                <thead> 
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
            </thead>
            <tbody>
              {{-- DADOS VIA AJAX --}}
           </tbody>
         </table>
        </div>
    </div>

    {{-- MODAL PRODUCT --}}
    <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalProduct-title">TituloModal</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="msgdlg"></div>
          <form id="form-product" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="id" class="col-form-label col-form-label-sm">Código:</label>
                        <input type="text" id="id" name="id" readonly class="form-control"  placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label col-form-label-sm">Nome do Produto:</label>
                        <input type="text" id="name" name="name" required class="form-control"  placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label col-form-label-sm">Descrição:</label>
                        <textarea rows="3" id="description" required name="description" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-form-label col-form-label-sm">Preço:</label>
                        <input type="tel" id="price" required name="price" class="form-control moeda"  placeholder="mínimo 100,00">
                    </div>
                </div>
                 {{-- DIV PHOTO --}}
                 <div class="col-sm-6">
                    <div class="card" >
                        <input type="hidden" name="photo_edit" id="photo_edit" value="0">
                        <div class="img-box" style="min-height: 292px">
                            <img class="card-img-top" src="" id="show_photo">
                        </div>   
                        <div class="card-body">
                           <input type="file" name="photo" id="photo" class="input-file"  accept="image/gif, image/jpeg, image/png"/>
                           <button class='btn btn-info' type="button" id="selecionar"><i class="fas fa-camera "></i></button>
                           <button class='btn btn-danger' type="button" onclick="RemoverImg()"><i class="fas fa-trash-alt "></i></button>
                        </div>
                      </div>
                </div>
                {{-- END PHOTO --}}
            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit" id="btnSalvarProduct"><i class="fas fa-save"></i>
            SALVAR</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-times-circle"></i>
            FECHAR</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- END MODAL PRODUCT --}}


 {{-- MODAL SALE --}}
 <div class="modal fade" id="modalSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="modalSale-title">TituloModal</h5>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </button>
     </div>
     <div class="modal-body">
       <div id="msgsale"></div>
       <form id="form-sale" method="POST">
           <input type="hidden" name="sale_id" id="sale_id" value="">
        <h3>Dados do Cliente</h3>
        <div class="form-row">
            
            <fieldset class="form-group col-sm-5">
            <label for="bairro" class="col-form-label col-form-label-sm">CPF:</label>
            <div class=" input-group-prepend">

            <input required type="text" class="form-control" name="client_cpf" id="client_cpf" placeholder="pesquise o cliente ou cadastre" aria-label="Username" aria-describedby="basic-addon1">
                <button onclick="searchClient($('#client_cpf').val())" type="button" class="btn btn-primary" style='padding: 14.5px 16px;'>
                    <i class='fa fa-search'></i></button>
              </div> 
            </fieldset>
            
            <fieldset class="form-group col-sm-4">
              <label for="name" class="col-form-label col-form-label-sm">Nome:</label>
              <input required type="text" class="form-control" id="client_name" name="client_name" placeholder="">
            </fieldset>
           
            <fieldset class="form-group col-sm-3">
              <label for="email" class="col-form-label col-form-label-sm">E-mail:</label>
              <input required type="email" class="form-control" id="client_email" name="client_email" placeholder="">
            </fieldset>
          </div> 
          <hr>
          <h3>Produto</h3>
          <div class="form-row">
           
            <fieldset class="form-group col-sm-6">
                <label for="name" class="col-form-label col-form-label-sm">Produto:</label>
                <select class="form-control" id="cbProducts" name="product_id">
                    {{-- DADOS VIA AJAX --}}
                </select>
              </fieldset>

              <fieldset class="form-group col-sm-2">
                <label for="product_price" class="col-form-label col-form-label-sm">Vlr Unit.:</label>
                <input type="text" readonly class="form-control" id="product_price" value="0,00">
              </fieldset>

            <fieldset class="form-group col-sm-2">
              <label for="quantidade" class="col-form-label col-form-label-sm">Qtd:</label>
              <input onchange="calculateTotal()" type="number" min="1" max="10" value="1" class="form-control" id="quantity" name="quantity">
            </fieldset>


           
            <fieldset class="form-group col-sm-2">
              <label for="sub-total" class="col-form-label col-form-label-sm">Sub-Total:</label>
              <input type="text" readonly class="form-control" id="sub-total" name="sub-total" value="0,00">
            </fieldset>
          </div>
          <hr>
          <h3>Informações da Venda</h3>
          <div class="form-row">
           
            <fieldset class="form-group col-sm-3">
                <label for="name" class="col-form-label col-form-label-sm">Data:</label>
                <input type="date" class="form-control" id="date" name="date" value="">
              </fieldset>

            <fieldset class="form-group col-sm-3">
              <label for="name" class="col-form-label col-form-label-sm">Status:</label>
              <select id="status" name="status" class="form-control">
                <option selected value="1">Aprovado</option>
                <option value="2">Cancelado</option>
                <option value="3">Devolvido</option>
            </select>
            </fieldset>
           
            <fieldset class="form-group col-sm-3">
              <label for="discount" class="col-form-label col-form-label-sm">Desconto:</label>
              <input onchange="calculateTotal()"  value="0,00" type="tel" class="form-control moeda" id="discount" name="discount" placeholder="">
            </fieldset>

            <fieldset class="form-group col-sm-3">
                <label for="total" class="col-form-label col-form-label-sm">Total:</label>
                <input type="tel" readonly class="form-control" id="total" name="total" value="0,00">
              </fieldset>
          </div>
    </div>
      <div class="modal-footer">
       <button class="btn btn-primary" type="submit" id="btnSalvarSale"><i class="fas fa-save"></i>
         SALVAR</button>
       <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-times-circle"></i>
         FECHAR</button>
       </form>
     </div>
   </div>
 </div>
</div>
{{-- END MODAL SALE --}}

@endsection

@section('script')
<script src="{{ asset('js/photo.js') }}"></script> 
<script src="{{ asset('js/dashboard.js') }}"></script> 

<script type="text/javascript">
  window.onload = function () 
  {
    populateComboClient();
    listProducts();
    getResultSales();
  }
</script> 
@endsection
