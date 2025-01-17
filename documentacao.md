## Documentação do desafio Back-end Multiplier

*** No header das requisições deve conter "Accept = application/json" explicítando que a requisição espera json como resposta,
"Content-Type = application/json" para permitir o envio de requisição no formato de JSON e "Authorization = Bearer  eyJ0eXAiOiJK..." passando o token de autenticação para obter acesso as rotas;
Obs: Todas as rotas necessita de autenticação.

Preparando o Ambiente:
- **1°** Deve criar um banco de dados mysql com o nome "desafio", username: root e password:''  (sem senha).
- **2°** Execute na raiz do projeto o comando "composer install", para instalar as dependências.
- **3°** Execute o comando "php artisan migrate", para fazer as migrações para o BD.  
- **4°** Execute "php artisan db:seed", para popular o banco com 10K clientes, 50 cardapios e 400K pedidos.
- **5°** E por fim para rodar a aplicação execute "php artisan serve", o servidor está servido em http://localhost:8000 .

Será criado tbm 4 usuários:
 ```json
name: deleon
email: deleon@
password: 1234
cargo: garcom 
```
 ```json
name: luiz
email: luiz@
password: 1234
cargo: garcom 
```
 ```json
name: pedro
email: pedro@
password: 1234
cargo: cozinheiro 
```
 ```json
name: admin
email: admin@
password: 1234
cargo: admin 
```
Obs: Todas as rotas necessita de autenticação.

## EndPoints
#### Rotas Autênticação
- **POST  |  http://localhost:8000/api/login**  |  Fazer login, { "email":"admin@", "password":"1234" }
- **POST  |  http://localhost:8000/api/v1/logout**  |  Fazer logout  
- **POST  |  http://localhost:8000/api/v1/refresh**  |  Fazer a renovação do token 
- **POST  |  http://localhost:8000/api/v1/me**  |  Recuperar dados do usuário logado

#### Rotas Pedidos
- **GET  |  http://localhost:8000/api/v1/pedidos/{id}**   |  Exibi um pedido em questão
- **GET  |  http://localhost:8000/api/v1/pedidos**   |  Se garçom retorna todos o pedidos realizados por dele com status='fazendo', Se cozinheiro retorna todos os pedidos em status='a fazer e fazendo'.
- **GET  |  http://localhost:8000/api/v1/pedidos?dia=31**  |  Só p/ admin, retorna pedidos do dia passado no parametro.
- **GET  |  http://localhost:8000/api/v1/pedidos?semana**  |  Só p/ admin, retorna pedidos da semana atual.
- **GET  |  http://localhost:8000/api/v1/pedidos?mes=10**  |  Só p/ admin, retorna pedidos do mês passado no parametro.
- **GET  |  http://localhost:8000/api/v1/pedidos?mesa=3**  |  Só p/ admin, retorna pedidos da mesa passada no parametro.
- **GET  |  http://localhost:8000/api/v1/pedidos?cliente=321**  |  Só p/ admin, retorna pedidos relacionado ao cliente.

- **POST  |  http://localhost:8000/api/v1/pedidos**  |  Add um cliente, { "numero":"21" }  
- **PUT  |  http://localhost:8000/api/v1/pedidos/{id}**   |  Editar o cliente em questão
- **DELETE  |  http://localhost:8000/api/v1/pedidos/{id}**  |  Exclui cliente em questão

### Os recursos das rotas cardapios, mesas e clientes somente o usuário cujo o cargo é admin tem a permissão.
#### Rotas Cardápio
- **GET  |  http://localhost:8000/api/v1/cardapios/{id}**   |  Exibi um cardapio em questão
- **GET  |  http://localhost:8000/api/v1/cardapios**   |  Lista todos o cardapios
- **POST  |  http://localhost:8000/api/v1/cardapios**  |  Add um cardapio, { "nome":"nome_cardapio", "descicao":"descriçao do cardapio" }  
- **PUT  |  http://localhost:8000/api/v1/cardapios/{id}**   |  Editar o cardapio em questão
- **DELETE  |  http://localhost:8000/api/v1/cardapios/{id}**  |  Exclui cardapio em questão

#### Rotas Mesas
- **GET  |  http://localhost:8000/api/v1/mesas/{id}**   |  Exibi uma mesa em questão
- **GET  |  http://localhost:8000/api/v1/mesas**   |  Lista todos o mesas
- **POST  |  http://localhost:8000/api/v1/mesas**  |  Add um mesa, { "numero":"21" }  
- **PUT  |  http://localhost:8000/api/v1/mesas/{id}**   |  Editar o mesa em questão
- **DELETE  |  http://localhost:8000/api/v1/mesas/{id}**  |  Exclui mesa em questão

#### Rotas Clientes
- **GET  |  http://localhost:8000/api/v1/clientes/{id}**   |  Exibi um cliente em questão
- **GET  |  http://localhost:8000/api/v1/clientes**   |  Lista todos o clientes
- **POST  |  http://localhost:8000/api/v1/clientes**  |  Add um cliente, { "numero":"21" }  
- **PUT  |  http://localhost:8000/api/v1/clientes/{id}**   |  Editar o cliente em questão
- **DELETE  |  http://localhost:8000/api/v1/clientes/{id}**  |  Exclui cliente em questão


# Abaixo detalhamento das rotas
<img height="100%" src="routeList.png"/>
