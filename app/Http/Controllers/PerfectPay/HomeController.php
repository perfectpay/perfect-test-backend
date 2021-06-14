<?php

namespace App\Http\Controllers\PerfectPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // criei como invoke pois só haverá um retorno da página principal, mesmo
        // que ele seja composto de alguns parametros
        return view('site.home.index');
    }
}
