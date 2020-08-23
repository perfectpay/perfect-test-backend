# PARTE DA EMPRESA

 # Você quer ser um desenvolvedor Backend na Perfectpay? 
 O desafio é desenvolver um sistema de vendas onde consiste um cadastro de produtos, o próprio cadastro de vendas onde será preenchido alguns dados também referente a cliente, uma dashboard onde estará
centralizado os dados de produtos, consulta de vendas e um relatório simplificado de vendas.
 
 # Instruções
 - O foco principal do nosso teste é o backend. Para facilitar você poderá utilizar os blade.php que disponibilizamos no projeto.
 - Fique à vontade para usar bibliotecas/componentes externos
 - Seguir princípios **CLEAN CODE** 
 - Utilize boas práticas de programação
 - Utilize boas práticas de git
 - Documentar como rodar o projeto
 
 # Requisitos
 - O sistema deverá ser desenvolvido utilizando a linguagem PHP no framework Laravel.
 - Você deve criar um CRUD que permita cadastrar as seguintes informações:
 	- **Produto**: Nome, Descrição e Preço.
 	- **Venda**: Produto,Data da venda, Quantidade do produto, Desconto, Status da venda.
	- **Cliente**: Nome, Email, CPF.
 - Salvar as informações necessárias em um banco de dados (relacional) de preferência MySql.
 - Exibir todos os dados na dashboard conforme exemplo deixado na blade.php.

 
 # Opcionais
 - Testes automatizados com informação da cobertura de testes
 - Upload de imagem no cadastro de produtos
 
 # O que será avaliado
 - Estrutura e organização do código e dos arquivos
 - Qualidade
 - Enfim, tudo será observado e levado em conta
 
 # Como iniciar o desenvolvimento
 - Fork esse repositório na sua conta do GitHub.
 - Crie uma branch com o nome desafio
 
 Qualquer dúvida sobre o teste, fique a vontade para entrar em contato conosco.


# PARTE DO DESENVOLVEDOR

# Como rodar o projeto
- Para facilitar o entendimento e execução desse projeto, o arquivo **.env** ficará disponível aqui nesse repositório com as informações necessárias para fazer o projeto funcionar.
- Se certificar que o computador que está rodando o projeto possui a versão 7.3 ou superior do PHP
- Executar o comando `composer install`
- Rodar o servidor PHP. Para esse projeto eu rodei o servidor na porta 8001 com o comando `php -S 0.0.0.0:8001 -t public`
- Rodar o servidor de banco de dados. Para esse projeto eu usei o banco MySQL, e configurei ele através do **xampp**
- Para criar as tabelas é necessário criar o banco `perfectpay` (conforme consta no **.env**) e rodar o comando `php artisan migrate` no terminal
- Obs.: Como está tudo dentro de um projeto só, para obter o resultado de Produto, por exemplo, estou chamando a função de detalhar produto, ao invés de chamar a rota da api de detalhar produto. Quando for acessar essa api de um sistema diferente (ou de um aplicativo mobile, por exemplo, lembrar de fazer a chamada das rotas corretamente)
- Obs2.: Caso vá testar em um local com informações diferentes das que estão nesse arquivo **README**, lembrar de alterar as variáveis do arquivo **.env** também.
