<?php

namespace App\Http\Controllers\PerfectPay;

use App\Contact;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.contact.index');
    }

    public function form(ContactFormRequest $request)
        // criei um request especifico para os dados de contato
    {
        //metodo responsavel pelo formulario post da pagina contato
        $contact = Contact::create($request->all());
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um

        Session::flash('message','Message info');
        return redirect()->back()->with('message', 'Mensagem enviada com sucesso!');
    }

    
}
