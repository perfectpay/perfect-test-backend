<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Helper 
{
    public static function clearCurrency($text)
    { 
       $text = str_replace(".","",$text);
       $text = str_replace(",",".",$text);
       $text = str_replace("R$","",$text);
       
       if ($text == '')
        return '0';
        
       return $text;
    }

public static function savePhoto($photo, $type, $size)
{
        $file       = $photo;
        $extension  = $photo->getClientOriginalExtension();
        $fileName   = time() . random_int(100, 999) .'.' . $extension; 
        
        $destinationPath = 'img/'.$type.'/';
        $url             = 'img/'.$type.'/'.$fileName;
        
        $fullPath = $destinationPath.$fileName;
        
        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775);
        }

        $image = Image::make($file)
            ->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $image->save($fullPath, 100);
        return $url;
}

public static function DataMysql($data)
{
  $dataMysql = implode("-",array_reverse(explode("/",$data)));
  return $dataMysql;	
}

//https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
public static function validaCPF($cpf) 
{ 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
return true;
}
}