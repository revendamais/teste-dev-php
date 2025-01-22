# Teste Dev PHP

Este projeto utiliza Docker para criar um ambiente completo com Laravel, PHP, Nginx e MySQL.

## Pré-requisitos

- Docker e Docker Compose instalados na máquina.

## Como Iniciar o Projeto

### 1. Clone o repositório

```bash
git clone <URL-DO-REPOSITÓRIO>
cd teste-dev-php
```

### 2. Suba os containers

Execute o comando abaixo para construir e subir todos os containers:

```bash
docker-compose up -d --build
```

### 3. Configuração do Laravel

- Durante o build, o container `app` executa o `composer install` para instalar as dependências do Laravel.
- Certifique-se de que as configurações do banco de dados no arquivo `.env` do Laravel estão de acordo com as definições
  do `docker-compose.yml`:

```env
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 4. Ajuste de Permissões

Ajuste as permissões dos diretórios `storage` e `bootstrap/cache` para evitar problemas durante a execução do Laravel:

```bash
chmod -R 777 storage bootstrap/cache
```

### 5. Acessando o Projeto

Abra o navegador e acesse a aplicação através do endereço:

[http://localhost:8080](http://localhost:8080)

### 6. Executando Comandos no Container do Laravel

Para executar comandos (como `artisan`, por exemplo) dentro do container `app`, utilize:

```bash
docker exec -it laravel-app bash
```

### 7. Rodar os seguintes comandos para iniciar o projeto

```bash
#Gerar a chave do larave
php artisan key:generate

#Rodar as migrations
php artisan migrate

#Limpar possíveis caches
php artisan optimize:clear
```

## Documentação das Rotas

Abaixo está a documentação das rotas disponíveis no sistema para gerenciar fornecedores e buscar informações de CNPJ.
Todas as rotas estão organizadas e prefixadas conforme necessário.

---

### **Rotas com Prefixo: `/suppliers`**

Rotas relacionadas à gestão de fornecedores.

### **1. Listar Fornecedores**

- **Descrição:** Retorna uma lista de todos os fornecedores cadastrados.
- **Método HTTP:** `GET`
- **URL:** `/suppliers`
- **Resposta de Sucesso (`200`):**
  ```json
  {
      "status": "success",
      "message": "Fornecedores encontrados com sucesso!",
      "data": [
          {
              "id": 1,
              "company_name": "Empresa Teste",
              "document_type": "cnpj",
              "document_number": "12345678000195",
              "email": "teste@empresa.com",
              "telephone": "11999999999",
              "address": "Rua Exemplo, 123"
          }
      ]
  }
  ```

---

### **2. Criar Fornecedor**

- **Descrição:** Adiciona um novo fornecedor ao sistema.
- **Método HTTP:** `POST`
- **URL:** `/suppliers`
- **Body Exemplo:**
  ```json
  {
      "company_name": "Empresa Nova",
      "document_type": "cpf",
      "document_number": "12345678909",
      "email": "nova@empresa.com",
      "telephone": "11999999999",
      "address": "Rua Nova, 456"
  }
  ```
- **Resposta de Sucesso (`201`):**
  ```json
  {
      "status": "success",
      "message": "Fornecedor criado com sucesso!",
      "data": {
          "id": 2,
          "company_name": "Empresa Nova",
          "document_type": "cpf",
          "document_number": "12345678909",
          "email": "nova@empresa.com",
          "telephone": "11999999999",
          "address": "Rua Nova, 456"
      }
  }
  ```

---

### **3. Exibir Detalhes de um Fornecedor**

- **Descrição:** Retorna os detalhes de um fornecedor específico com base no `id`.
- **Método HTTP:** `GET`
- **URL:** `/suppliers/{id}`
- **Exemplo de URL:** `/suppliers/1`
- **Resposta de Sucesso (`200`):**
  ```json
  {
      "status": "success",
      "message": "Fornecedor localizado com sucesso!",
      "data": {
          "id": 1,
          "company_name": "Empresa Teste",
          "document_type": "cnpj",
          "document_number": "12345678000195",
          "email": "teste@empresa.com",
          "telephone": "11999999999",
          "address": "Rua Exemplo, 123"
      }
  }
  ```
- **Erro (`404`):**
  ```json
  {
      "status": "error",
      "message": "Fornecedor não encontrado."
  }
  ```

---

### **4. Atualizar Fornecedor**

- **Descrição:** Atualiza as informações de um fornecedor existente.
- **Método HTTP:** `PUT`
- **URL:** `/suppliers/{id}`
- **Exemplo de URL:** `/suppliers/1`
- **Body Exemplo:**
  ```json
  {
      "company_name": "Empresa Atualizada",
      "document_type": "cnpj",
      "document_number": "12345678000195",
      "email": "atualizado@empresa.com",
      "telephone": "11988888888",
      "address": "Rua Atualizada, 789"
  }
  ```
- **Resposta de Sucesso (`200`):**
  ```json
  {
      "status": "success",
      "message": "Fornecedor atualizado com sucesso!",
      "data": {
          "id": 1,
          "company_name": "Empresa Atualizada",
          "document_type": "cnpj",
          "document_number": "12345678000195",
          "email": "atualizado@empresa.com",
          "telephone": "11988888888",
          "address": "Rua Atualizada, 789"
      }
  }
  ```
- **Erro (`404`):**
  ```json
  {
      "status": "error",
      "message": "Fornecedor não encontrado."
  }
  ```

---

### **5. Excluir Fornecedor**

- **Descrição:** Remove um fornecedor do sistema.
- **Método HTTP:** `DELETE`
- **URL:** `/suppliers/{id}`
- **Exemplo de URL:** `/suppliers/1`
- **Resposta de Sucesso (`200`):**
  ```json
  {
      "status": "success",
      "message": "Fornecedor excluído com sucesso!"
  }
  ```
- **Erro (`404`):**
  ```json
  {
      "status": "error",
      "message": "Fornecedor não encontrado."
  }
  ```

---

## **Rota para Buscar CNPJ**

### **6. Buscar Informações de CNPJ**

- **Descrição:** Busca informações detalhadas de um CNPJ usando a API BrasilAPI.
- **Método HTTP:** `GET`
- **URL:** `/searchcnpj/{cnpj}`
- **Exemplo de URL:** `/searchcnpj/12345678000195`
- **Resposta de Sucesso (`200`):**
  ```json
  {
      "status": "success",
      "message": "CNPJ localizado com sucesso.",
      "data": {
          "cnpj": "12345678000195",
          "razao_social": "Empresa Teste Ltda",
          "endereco": "Rua Exemplo, 123",
          "telefone": "11999999999",
          "email": "contato@empresateste.com"
      }
  }
  ```
- **Erro de Validação (`400`):**
  ```json
  {
      "status": "error",
      "message": "CNPJ inválido."
  }
  ```
- **Erro de Não Encontrado (`404`):**
  ```json
  {
      "status": "error",
      "message": "CNPJ não encontrado na API."
  }
  ```

---

## Estrutura do Projeto

- **Dockerfile**: Define a imagem e as dependências para o ambiente PHP com Laravel.
- **docker-compose.yml**: Configura os serviços necessários (app, webserver e database).
- **docker/nginx/default.conf**: Arquivo de configuração do Nginx para servir o projeto Laravel.

---

Agora você tem um ambiente completo para desenvolver com Laravel utilizando Docker. Divirta-se programando!