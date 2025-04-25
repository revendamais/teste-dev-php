# Inicializando o projeto

-   Faça o clone do repositório: `git clone`
-   Após baixar o projeto siga para as instruções contida em [infra/README.md](infra/README.md)

## Utilizando a API

-   Abra o postman ou outro software de sua preferencia para acessar a api.

-   Para ter acesso a api voce deve criar uma conta no endpoint POST http://127.0.0.1:8000/api/register

    > O body da request deve conter os campos name ,email e password

    > A request deve retornar 201.

-   Para logar a requisição é no endpoit POST http://127.0.0.1:8000/api/login

    > O body da request deve conter os campos email e password criado no passo anterior

    > A request deve retornar 200 contendo o access_token que será utilizado para realizar as operações para o endpoint do fornecedor.

-   O endpoint POST http://127.0.0.1:8000/logout de logout requer que access_token obtido no login seja passado como Bearer token na autenticação.
    > A request deve retornar 200 com a mensagem de 'logged out'.

### Api de fornecedor

-   O CRUD de fornecedor está disponivel no caminho http://127.0.0.1:8000/api/fornecedor para uso com o access_token obtido no login.

    -   Criar Fornecedor: A criação de um fornecedor está disponivel no endpoint POST http://127.0.0.1:8000/api/fornecedor

        > O body da request aceita os campos nome, documento, email, telefone, endereco

        > O nome e documento são obrigatórios

    -   Editar Fornecedor: A edição de um fornecedor está disponivel em PATCH http://127.0.0.1:8000/api/fornecedor/{id}
    -   Excluir Fornecedor: A exclusão de um fornecedor está disponivel em DELETE http://127.0.0.1:8000/api/fornecedor/{id}
    -   Listar Fornecedor: A lista de fornecedores está diponivel em GET http://127.0.0.1:8000/api/fornecedor
    -   Buscar por dados de um cnpj: É possivel fazer uma busca por dados de um cnpj no endpoint GET http://127.0.0.1:8000/api/fornecedores/cnpj/{cnpj}
