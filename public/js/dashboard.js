function listSales()
  {   
   let data = $("#form-filtersales").serializeArray();

   $("#table-sales > tbody > tr").remove();
   $('#table-sales > tbody').append('<tr><td colspan="4">Carregando...</td></tr>');
   let linhas = '';
   
    $.getJSON('/sale', data, function(sales) {
          sales.forEach(sale => { 
                linhas += `<tr>
                                <td>${sale.product.name}</td>
                                <td>${DataddmmY(sale.date)}</td>
                                <td>R$ ${Moeda(sale.total)}</td>
                                <td>
                                    <button onclick='modalSale(${sale.id})' class='btn btn-primary'>Editar</a>
                                </td>
                           </tr>`;
            })
            $("#table-sales > tbody > tr").remove();
             if(linhas)
                $('#table-sales > tbody').append(linhas)
             else
                $('#table-sales > tbody').append('<tr><td colspan="4"><i>Nenhuma venda encontrada</i></td></tr>');
            })
            .fail(function() {
                showAlert('Opss...','Falha ao recuperar vendas','error');
        });  
}

function populateComboProduct(product_id)
{
    $("#cbProducts").empty();
    $("#cbProducts").append('<option value="0">Carregando...</option>').trigger('change');
    let options = '';
    $.getJSON('/product', function(products) {
        products.forEach(product => { 
                options +=`<option value="${product.id}" data-vlrunit ="${product.price}" >${product.name}</option>`;
            })
             $("#cbProducts").empty();
             if(options)
             { 
                $("#cbProducts").append(`<option value="0" data-vlrunit ="0" >Selecione...</option>`);

                $("#cbProducts").append(options);
                if(product_id)
                 $("#cbProducts").val(product_id).trigger('change');
                else
                $("#cbProducts").val(0).trigger('change'); 
                 
             }
              else
                 $("#cbProducts").append('<option value="">Nenhum produto cadastrado...</option>').trigger('change');
            })
            .fail(function() {
                showMsg('#msgsale', 'Falha ao recuperar produtos...','info');

        });  
}

var select = document.getElementById('cbProducts');
select.addEventListener('change', function() {
    var vlrunit = this.querySelector('option:checked').dataset.vlrunit;
   $("#product_price").val('R$ '+Moeda(vlrunit));
   calculateTotal(); 
});

function populateComboClient()
{
    $("#cbClients").empty();
    $("#cbClients").append('<option value="0">Carregando...</option>').trigger('change');
    let options = '';
    $.getJSON('/client', function(clients) {
            clients.forEach(client => { 
                options +=`<option value="${client.id}">${client.name}</option>`;
            })
             $("#cbClients").empty();
             if(options)
             {
                $("#cbClients").append('<option value="0">Selecione...</option>');
                $("#cbClients").append(options);
             }
             else
                 $("#cbClients").append('<option value="">Nenhum cliente cadastrado...</option>').trigger('change');
            })
            .fail(function() {
                showAlert('Opss...','Falha ao recuperar clientes','error');
        });  
}

function calculateTotal()
{
    let vlrunit = textToNumber($("#product_price").val());
    let qtd     = textToNumber($("#quantity").val());
    let discount     = textToNumber($("#discount").val());

    if (qtd < 1) qtd = 1;
    if (qtd > 10) qtd = 10; 
    $("#quantity").val(qtd)

    if (discount < 0) discount = 0;
    if (discount > 100) discount = 100; 
    $("#discount").val(Moeda(discount))
    
    let subtotal = vlrunit * qtd;
    let total = subtotal - discount;

    $("#sub-total").val("R$ "+Moeda(subtotal));
    $("#total").val("R$ "+Moeda(total));
}

function listProducts()
{
   $("#table-products > tbody > tr").remove();
   $('#table-products > tbody').append('<tr><td colspan="3">Carregando...</td></tr>');
   let linhas = '';
    $.getJSON('/product', function(products) {
          products.forEach(product => { 
                linhas += `<tr>
                                <td>${product.name}</td>
                                <td>R$ ${Moeda(product.price)}</td>
                                <td>
                                    <button onclick='modalProduct(${JSON.stringify(product)})' class='btn btn-primary'>Editar</a>
                                </td>
                           </tr>`;
            })
            $("#table-products > tbody > tr").remove();
             if(linhas)
                $('#table-products > tbody').append(linhas)
             else
                $('#table-products > tbody').append('<tr><td colspan="3">Nenhum produto cadastrado</td></tr>');
            })
            .fail(function() {
                showAlert('Opss...','Falha ao recuperar produtos','error');
        });  
}

function modalSale(id)
{ 
  $("#msgsale").empty();
  $('#form-sale').each (function(){this.reset(); });
  $("#sale_id").val(id);

  if(id)
  { 
    $.getJSON(`/sale/${id}`, function(sale) { console.log(sale);
          
        $("#client_cpf").unmask();
        $("#client_cpf").val(sale.client.cpf);
        $('#client_cpf').mask('000.000.000-00', {reverse: true});

        $("#client_name").val(sale.client.name);
        $("#client_email").val(sale.client.email);
        populateComboProduct(sale.product_id);
        $("#product_price").val('R$ '+Moeda(sale.product.price));
        $("#quantity").val(sale.quantity);
        $("#sub-total").val('R$ '+Moeda(sale.product.price * sale.quantity));
        $("#date").val(sale.date);
        $("#status").val(sale.status);
        $("#discount").val(Moeda(sale.discount));
        $("#total").val('R$ '+Moeda(sale.total));
        $("#modalSale-title").html('Editar Venda - '+id);
  })
   .fail(function(dados) { 
             showMsg('#msgsale', 'Erro ao recuperar dados...','danger');
            })
    .done(function(dados) { 

    }) 

}
else
{ 
  populateComboProduct();
  $("#modalSale-title").html('Nova Venda');
}
   
 $("#modalSale").modal('show'); 

}

function searchClient(cpf)
{   
    if(cpf)
    {
    $("#msgsale").empty();
    $.getJSON(`/client/${cpf}`, function(client) {
      $("#client_name").val(client.name);
      $("#client_email").val(client.email);
    })
     .fail(function(dados) { 
         if(dados.responseText)
           showMsg('#msgsale', 'CPF inválido!','danger');
         else
           showMsg('#msgsale', 'Cliente não cadastrado. Informe o nome e-mail para cadastrar','info');
       })
      .done(function(dados) { 
      })
    } 
}

function modalProduct(product)
{ 
  $("#msgdlg").empty();
  $('#form-product').each (function(){this.reset(); });
//   RemoverImg();
  //se o objeto product for passado como parametro preparamos a edicao no modal
  //OBS: outra opção seria receber apenas o ID do product e recuperar os demais campos via ajax
  if(product)
  { 
     $("#id").val(product.id);
     $("#name").val(product.name);
     $("#description").val(product.description);
     $("#price").val(Moeda(product.price));
     showImgFromDB(product.photo);

     $("#modalProduct-title").html('Editar Produto');
  }
  else
  {
    $("#modalProduct-title").html('Cadastrar Produto');
    RemoverImg();
  } 
  $("#modalProduct").modal('show'); 
}

// POST FORM SALE
$('#form-sale').submit(function(){
  event.stopPropagation(); 
  event.preventDefault(); 
  let dados = $('#form-sale').serializeArray();

  let id = $("#sale_id").val();
  if(id == '')
  { 
    url = '/sale';
    type = 'post';
  }
  else
  { 
    url = '/sale/update/'+id;
    type = 'put';
  }

  $.ajax({  
      type: type,
      url: url,
      data : dados,
      success: function(data)  
      {  
         listSales();
         populateComboClient();
         getResultSales();
         showAlert('Salvo com sucesso!','','success');
         $("#modalSale").modal('hide');
      },
      error: function (data)
       { 
        $("#msgsale").empty();
        $.each(data.responseJSON.errors, function (key, value) 
        {  
          showMsg('#msgsale', value,'danger');
        });
       },
       complete: function (data){
      } 
            
    });	
return false;
});

//submit form products
$('#form-product').submit(function(){
  event.stopPropagation();
  event.preventDefault(); 
  let dados = new FormData($('#form-product')[0]);
  let id = $("#id").val();
  if(id == '')
    url = '/product';
  else
    url = '/product/update/'+id;

  $.ajax({  
      type: 'POST',
      enctype: 'multipart/form-data',
      url: url,
      data : dados,
      processData: false,
      contentType: false,
      cache: false,
      success: function(data)  
      {  
        listProducts();
         showAlert('Salvo com sucesso!','','success');
          $("#modalProduct").modal('hide');
      },
      error: function (data)
       { 
        $("#msgdlg").empty();
        $.each(data.responseJSON.errors, function (key, value) 
        {  
          showMsg('#msgdlg', value,'danger');
        });
       },
       complete: function (data){
      } 
            
    });	
return false;
});


function getResultSales()
{  
   $("#table-result > tbody > tr").remove();
   $('#table-result > tbody').append('<tr><td colspan="2">Carregando...</td></tr>');
   let linhas = '';

    $.getJSON('/saleresult', function(results) {
        results.forEach(result => { 
                linhas += `<tr>
                               <td>${xStatus(result.status)}</td>
                               <td>${result.qtd}</td>
                               <td>R$ ${Moeda(result.total)}</td>
                           </tr>`;
            });
           
            $("#table-result > tbody > tr").remove();
             if(linhas)
                $('#table-result > tbody').append(linhas)
             else
                $('#table-result > tbody').append('<tr><td colspan="2">Nenhuma venda realizada</td></tr>');
       

    })
     .fail(function(dados) { 
         showMsg('#msgresult', 'Erro ao recuperar dados...','danger');
       })
      .done(function(dados) { 
      }) 
}

function xStatus(cod)
{
   switch (cod) {
       case  1:
             return 'Aprovados'
           break;
           case  2:
             return 'Cancelados'
           break;
           case  3:
             return 'Devolvidos'
           break;
   } 
}

$('#client_cpf').mask('000.000.000-00', {reverse: true});