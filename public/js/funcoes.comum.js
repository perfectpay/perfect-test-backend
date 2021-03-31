function showAlert(title, message, icon)
{
        Swal.fire({
            position: 'top-end',
            icon: icon,
            title: title,
            text: message,
            showCloseButton: true,
            timer :2000
        }) 
}

function Moeda(n) {
   Low  = parseFloat(n);
   return Low.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
}

$('.moeda').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.',
    allowNegative: true,
    centsLimit : 2
});	

function textToNumber(valor)
  {
    var res = valor.toString().replace(".", "").replace(",", ".").replace("R$","");
 
   return Number(res);
  }

 function DataddmmY(xdata)
{
   return xdata.split('-').reverse().join('/');
}

function showMsg(elemento, texto, classe)
{ 
  $(elemento).append('<div class="alert alert-'+classe+' alert-dismissible fade show" role="alert">'+texto+
 '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">'+
    '<span aria-hidden="true">&times;</span></button></div>');

};