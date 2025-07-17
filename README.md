# Teste Dev PHP RevendaMais - Gestão de Fornecedores

Este projeto é uma API REST desenvolvida em Laravel para cadastro, listagem, atualização e exclusão de fornecedores. Também há integração com a [BrasilAPI](https://brasilapi.com.br/) para consulta de CNPJ.

---

## 🔧 Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Extensões do PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Curl

---

## 🚀 Instalação

1. Abra o terminal na raiz do projeto e instale as dependências com o Composer:

```bash
composer install
```

2. Copie o arquivo de exemplo de ambiente:

```bash
cp .env.example .env
```

3. Gere a chave da aplicação:

```bash
php artisan key:generate
```

4. Configure o `.env` com os dados do seu banco de dados MySQL:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=revendamais
DB_USERNAME=root
DB_PASSWORD=
```

5. Crie o schema `revendamais` no MySQL manualmente (ou pelo phpMyAdmin ou client MySQL).

6. Execute as migrations para criar as tabelas:

```bash
php artisan migrate
```

---

## 🧪 Executando o servidor local

```bash
php artisan serve
```

A API estará disponível em `http://localhost:8000`

---

## 🔁 Endpoints disponíveis

### Fornecedores

| Método | Rota | Descrição |
|--------|------|----------|
| GET    | `/api/cnpj/{cnpj}` | busca dados do CNPJ no BrasilAPI e retorna em json pronto para o insert (Apenas números) |
| GET    | `/api/fornecedores` | Lista todos os fornecedores (com paginação e filtros) |
| GET    | `/api/fornecedor/{id}` | Detalha um fornecedor específico |
| POST   | `/api/fornecedor` | Cria um novo fornecedor |
| PUT    | `/api/fornecedor/{id}` | Atualiza um fornecedor existente (exceto CNPJ) |
| DELETE | `/api/fornecedor/{id}` | Remove um fornecedor |

---

## 📦 Exemplo de Payload para busca com paginação

`GET /api/fornecedores?page=2&per_page=15`

---

## 📦 Exemplo de Payload para busca com filtro

`GET /api/fornecedores?nome=joão&email=gmail.com&sort_by=nome&sort_order=asc`

---

## 📦 Exemplo de Payload para criação de fornecedor

```json
{
  "nome": "Empresa ABC",
  "contato_numero": "11999999999",
  "contato_nome": "Fulano",
  "endereco_cep": "01310000",
  "endereco_rua": "Rua da Empresa",
  "endereco_numero": 123,
  "endereco_cidade": "São Paulo",
  "endereco_estado": "SP",
  "email": "contato@empresaabc.com",
  "cnpj": "00728551000176",
  "cpf": "12345678900"
}
```

---

## 🌐 Integração com BrasilAPI

Ao consultar um CNPJ, utilize a URL:

```
https://brasilapi.com.br/api/cnpj/v1/{cnpj}
```

É possível usar o Guzzle HTTP Client para consumir e tratar os dados. Certifique-se de configurar corretamente o certificado SSL do cURL no seu ambiente local (caso encontre erro `cURL error 60`).

---

## 🐛 Logs e Debug

- Arquivo de logs: `storage/logs/laravel.log`
- Para visualizar erros detalhados, defina no `.env`:

```dotenv
APP_DEBUG=true
```
---

## 👨‍💻 Padrão de Projeto

Este projeto utiliza o **Repository Pattern** para desacoplar a lógica de acesso a dados dos controllers.

---

## 📁 Estrutura de Pastas Importantes

- `app/Http/Controllers/FornecedorController.php`: Lógica de controle da API
- `app/Repositories/FornecedorRepository.php`: Camada de acesso aos dados
- `app/Repositories/FornecedorRepositoryIntervafe.php`: Interface do Repository
- `app/Services/BrasilApiService.php`: Lógica de integração com serviço externo
- `app/Models/Fornecedor.php`: Modelo da entidade
- `routes/api.php`: Definição das rotas públicas da API

---

## ✅ Testando a API

Você pode usar ferramentas como:

- [Postman](https://www.postman.com/)
- [Insomnia](https://insomnia.rest/)
- cURL via terminal

---

