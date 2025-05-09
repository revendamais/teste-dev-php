# Inicializando o projeto

-   Faça o clone do repositório: `git clone https://github.com/edblighter/teste-dev-php`
-   A seguir rode os comandos

    ```bash
    cd teste-dev-php
    git checkout teste
    ```

-   Após baixar o projeto siga para as instruções contida em [infra/README.md](infra/README.md)

### Api de fornecedor

-   O CRUD de fornecedor está disponivel no endpoint http://app.localhost:8000/api/suppliers .

    -   Listar Fornecedores: A listagem paginada de fornecedores está disponivel no endpoint GET http://app.localhost:8000/api/suppliers

        > os argumentos do paginador sao ?page={}&per_page={}&order={}

    -   Criar Fornecedor: A criação de um fornecedor está disponivel no endpoint POST http://app.localhost:8000/api/suppliers

        > O body da request aceita os campos name, type[CPF,CNPJ], document, email, phone, address

        > Todos os campos são obrigatórios no cadastro.

    -   Editar Fornecedor: A edição de um fornecedor está disponivel em PATCH http://app.localhost:8000/api/suppliers/{id}

        > O body da requisição aceita todos os parametros do create.

        > Nenhum campo é obrigatorio mas document e email serão validados caso enviados.

    -   Excluir Fornecedor: A exclusão de um fornecedor está disponivel em DELETE http://app.localhost:8000/api/suppliers/{id}

    -   Buscar por dados de um cnpj em API externa: É possivel fazer uma busca por dados de um cnpj no endpoint GET http://app.localhost:8000/api/externalsearch/{cnpj}
