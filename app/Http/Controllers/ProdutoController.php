<?php

namespace App\Http\Controllers;

use App\Http\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produtoService;

    public function __construct(ProdutoService $produtoService){
        $this->produtoService   = $produtoService;
    }

    public function cadastrarProduto(Request $request){
        $dados = $request->all();
        $imagem = file_get_contents($dados['file'][0]);

        $produto = [
            'nomeProduto'       => $dados['name'],
            'descricaoProduto'  => $dados['description'],
            'precoProduto'      => $dados['price'],
            'blobImagemProduto' => base64_encode($imagem)
        ];

        // Essa chamada poderia ser feita via requisição, pra de fato ser a comunicação com uma api, mas como o backend está no mesmo projeto, estou chamando o service mesmo.
        // Em um sistema mais completo também poderia ser feito um tratamento de erro adequado conforme a resposta do backend, e mostrar na tela o erro que deu de acordo com  a resposta da api
        $resultado = $this->produtoService->cadastrarProduto($produto);

        return redirect('/');
    }

    public function detalharProduto($idProduto){
        $dadosProduto = [
            'idProduto' => $idProduto
        ];

        $produto = $this->produtoService->detalharProduto($dadosProduto);

        $produto['data'] = collect($produto['data']);

        return view('detalhar_produto', [
            'produto' => $produto['data']
        ]);
    }

    public function alterarProduto(Request $request){
        $dados = $request->all();

        if(!isset($dados['file'][0])){
            $imagem = $dados['blobImagemProduto'];
        } else{
            $imagem = file_get_contents($dados['file'][0]);
            $imagem = base64_encode($imagem);
        }

        $produto = [
            'idProduto'         => $dados['idProduto'],
            'nomeProduto'       => $dados['name'],
            'descricaoProduto'  => $dados['description'],
            'precoProduto'      => $dados['price'],
            'blobImagemProduto' => $imagem,
            'situacao'          => 'A'
        ];

        // Essa chamada poderia ser feita via requisição, pra de fato ser a comunicação com uma api, mas como o backend está no mesmo projeto, estou chamando o service mesmo.
        // Em um sistema mais completo também poderia ser feito um tratamento de erro adequado conforme a resposta do backend, e mostrar na tela o erro que deu de acordo com  a resposta da api
        $resultado = $this->produtoService->alterarProduto($produto);

        return redirect('/products/detalhar/' . $dados['idProduto']);
    }
}
