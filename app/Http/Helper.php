<?php

namespace App\Http;

use Carbon\Carbon;

class Helper
{
    public function formatarCpfCnpj($cpfCnpj){
        $cnpj_cpf = preg_replace("/\D/", '', $cpfCnpj);

        if (strlen($cnpj_cpf) === 11) {
          return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    public function filtrarSomenteNumeros($string){
        return preg_replace("/[^0-9]/", "", $string);
    }

    public function formatarDataBr($data){
        $dataModificada = Carbon::createFromFormat('Y-m-d H:i:s', $data);

        return $dataModificada->format('d/m/Y H:i:s');
    }

    public function formatarDataBanco($data){
        $dataModificada = Carbon::createFromFormat('d/m/Y H:i:s', $data);

        return $dataModificada->format('Y-m-d H:i:s');
    }
}
