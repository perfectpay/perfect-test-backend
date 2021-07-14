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

 # Para Rodar o Projeto
 - Após extrair, basta você entrar na pasta raiz do projeto e rodar o comando: 
 ```
 composer install
 ```
 - Na  raiz do projeto copie o .env.example e cole no mesmo diretorio e renomeie-o para .env.
 - Crie sua base de dados e parametrize no arquivo .env.
 - Com a base de dados criada execute o seguinte comando para rodae as Migrations e criar as tabelas no BD:
 ```
 php artisan migrate
 ```
