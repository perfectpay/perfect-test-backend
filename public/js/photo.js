const noPicure = 'img/products/nopicture.png';

$('#selecionar').on('click', function() {
    $('#photo').trigger('click');
   });

  $("#photo").change(function(){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    ext = ext.toLowerCase();
    switch (ext) {
      case 'jpg':
      case 'jpeg':
      case 'png':
      case 'gif':
        showImgFromInput(this,'show_photo');
        break;
      default:
        showAlert('Opsss...','Formato não aceito! Tente jpg, png ou gif.','info');
        this.value = '';
        RemoverImg();
      }
  $("#photo_edit").val('1');

  });

function RemoverImg()
{
  $("#show_photo").attr('src', noPicure);
  $("#photo").val('');
  $("#photo_edit").val('1');
}

function showImgFromInput(input,idExibir) 
{
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#'+idExibir).attr('src', e.target.result);
    }

   reader.readAsDataURL(input.files[0]);
   $("#"+idExibir).show();

  }
}

function showImgFromDB(url)
{ 
  let picture = url ? url : noPicure;
  $('#show_photo').attr('src', picture);
  $('#show_photo').show();
}