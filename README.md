
# API de Fornecedores – Teste para Desenvolvedor PHP/Laravel

Este projeto consiste em uma API RESTful para o cadastro e gerenciamento de fornecedores, desenvolvida em Laravel como parte do teste técnico para a vaga de Desenvolvedor PHP/Laravel.

## ✅ Funcionalidades

- CRUD de Fornecedores (Create, Read, Update, Delete)
- Validação de CNPJ/CPF
- Busca de informações do CNPJ via BrasilAPI
- Filtros e ordenação na listagem
- Paginação de resultados
- Cache para otimizar performance (baseado em filtros)
- Padrões aplicados:
  - Service Layer
  - Repository Pattern
  - FormRequest
  - Resource
  - Cache implementado com `Cache::remember`

---

## 📦 Tecnologias

- PHP 8.1+
- Laravel 9.x
- MySQL
- Laravel Cache (filesystem)
- BrasilAPI (consulta CNPJ)

---

## 🚀 Instalação e Execução

Siga os passos abaixo para rodar o projeto localmente:

### 1. Clonar o repositório

```bash
git clone https://github.com/LeoPinhelli/teste-dev-php.git
cd teste-dev-php
git checkout teste-fornecedor
```

### 2. Instalar dependências

```bash
composer install
```

### 3. Criar o arquivo `.env`

```bash
cp .env.example .env
```

Edite o `.env` com suas configurações de banco de dados (MySQL). Exemplo:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fornecedores
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 5. Rodar as migrations

```bash
php artisan migrate
```

### 6. Popular com dados fake (opcional)

Se você tiver seeders configurados:

```bash
php artisan db:seed
```

---

## 🧪 Rodar servidor de desenvolvimento

```bash
php artisan serve
```

A API estará disponível em:  
📍 `http://localhost:8000/api/fornecedores`

---

## 🧾 Endpoints da API

| Método | Rota | Descrição |
|--------|------|-----------|
| GET    | `/api/fornecedores` | Lista paginada com filtros e ordenação |
| POST   | `/api/fornecedores` | Criação de fornecedor (valida CNPJ/CPF) |
| GET    | `/api/fornecedores/{id}` | Detalhes de um fornecedor |
| PUT    | `/api/fornecedores/{id}` | Atualiza um fornecedor |
| DELETE | `/api/fornecedores/{id}` | Remove um fornecedor |

---

## 🔁 Cache

A listagem de fornecedores é armazenada em cache por 10 minutos com base nos filtros usados.  
Ao criar, atualizar ou deletar um fornecedor, o cache é automaticamente limpo.

---

## 🧼 Limpeza de Cache Manual

```bash
php artisan cache:clear
```

---

## 🧪 Testes (caso queira adicionar)

```bash
php artisan test
```

---

## ❌ Docker

Este projeto **não utiliza Docker**.

---

## 📬 Postman

### Collection
Você pode importar a collection para testar a API no Postman:

[📁 Download da Collection](postman/fornecedores-api.postman_collection.json)

### Ambiente (Opcional)
[📁 Download do Ambiente](postman/fornecedores-api.postman_environment.json)

Ou, se preferir, use links brutos do GitHub, como:
[Download da Collection](https://github.com/LeoPinhelli/teste-dev-php/blob/teste-fornecedor/postman/fornecedores-api.postman_collection.json)

---
## 📮 Contato

Leonardo Sotti Pinhelli  
GitHub: [@LeoPinhelli](https://github.com/LeoPinhelli)

Email: leopinhelli@gmail.com

Telefone: 41 99638-9232

Linkedin: [Leonardo Sotti Pinhelli](https://www.linkedin.com/in/leonardo-sotti-pinhelli/)
