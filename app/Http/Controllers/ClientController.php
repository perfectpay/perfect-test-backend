<?php

namespace App\Http\Controllers;

use App\Client;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
 
 public function index()
 {
    $clients = Client::All();
    return json_encode($clients);
 }

 
 public function show($cpf)
 {
    $cpfvalid = Helper::validaCPF($cpf);

    if(!$cpfvalid)
    {
       return response('invalid',500);
    }

    $client_cpf = preg_replace('/[^0-9]/','',$cpf);
    $client = Client::where('cpf', $client_cpf)->first();

    if ($client)
      return json_encode($client);
 }

}
