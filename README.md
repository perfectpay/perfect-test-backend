# Aplicação Perfect pay CRUD
Cadastro de clientes, vendas e produtos.

## Funções desta aplicação

| Url | Descrição
|---|---|
| localhost:8000/ | dashboard
| localhost:8000/sales | painel de vendas
| localhost:8000/products  | painel de produtos
| localhost:8000/clients  | painel de clientes

Todos os painéis possuem opções de crud completas.

## Ambiente Docker
```
app: 
    build: .DockerFile
db:  
    image: mysql:5.7
nginx: 
    image: nginx:1.17-alpine
```

### Dockerfile do aplicativo
> .DockerFile // php:7.4-fpm

### Docker compose
> .docker-compose.yml

```
### configuração do entrypoint para o db criar as tabelas
./docker-compose/mysql/init_db.sql 

### configuração do Nginx
./docker-compose/nginx/perfectpay.conf
```

### Configuração das variáveis de ambiente
Crie o arquivo .env conforme exemplo
> .env
```
APP_NAME="perfect-pay"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_DEVELOPER=diegosantos.s@hotmail.com
APP_VERSION=1.0

LOG_CHANNEL=stack
FILESYSTEM_DRIVER=public

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=perfect-test-backend
DB_USERNAME=root
DB_PASSWORD=exemple
```

## Subindo os containers
Usaremos os comandos do docker-compose para compilar a imagem do aplicativo e executar os serviços que especificamos em nossa configuração.
Compile a imagem do app com o seguinte comando:
```
docker-compose build app
```

Quando a compilação terminar, execute o ambiente em modo de segundo plano com:
```
docker-compose up -d
```

Vamos executar o composer install para instalar as dependências do aplicativo:
```
docker-compose exec app composer install
```

Agora, vamos criar o link do nosso storage:
```
docker-compose exec app php artisan storage:link
```

A última coisa que precisamos fazer - antes de testar o aplicativo - é gerar uma chave única para o aplicativo com a artisan, a ferramenta de linha de comando do Laravel. Esta chave é usada para criptografar sessões de usuário e outros dados sensíveis:
```
docker-compose exec app php artisan key:generate
```
Agora, vá até seu navegador e acesse o nome de domínio ou endereço IP do seu servidor na porta 8000:
```
http://server_domain_or_IP:8000
```
Você pode usar o comando logs para verificar os registros gerados por seus serviços:
```
docker-compose logs nginx
```
Para fechar seu ambiente do Docker Compose e remover todos os seus contêineres, redes e volumes, execute:
```
docker-compose down -v
```


## Banco de dados 
> localhost porta: 3307


#### Dúvidas, Sugestões:
> diegosantos.s26@gmail.com
