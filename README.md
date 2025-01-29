## Teste para Desenvolvedor PHP/Laravel

Este documento contém as informações necessárias para a execução do projeto.

### 1. Requisitos

- PHP 8.3.7
- Laravel Installer 5.11.0
- Composer version 2.8.2
- Nodejs v20.13.1
- NPM 10.8.0
- MySQL 8.0.24

### 2. Comandos

Para instalar as dependências do PHP e do Node.js:

- **Instalar dependências PHP**:
  ```bash
  composer install

- **Instalar dependências do Node.js e rodar o build:**
  ```bash
  npm install && npm run build

### 3. Gerando arquivo .env
- **Copiar o arquivo .env.example para .env:**
  ```bash
  cp .env.example .env

- **Gerar a chave da aplicação: Execute o seguinte comando para gerar a chave da aplicação Laravel:**
  ```bash
  php artisan key:generate

### 4. Configurar conexão com o banco de dados MySQL
- **Abra o arquivo .env e altere as seguintes linhas para configurar a conexão com o banco de dados:**
  ```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nome_do_banco
  DB_USERNAME=seu_usuario
  DB_PASSWORD=sua_senha

- **Executar as migrações: Após configurar o banco de dados, execute as migrações para criar as tabelas necessárias:**
  ```bash
  php artisan migrate

- **Executar os seeders: Para preencher as tabelas com dados fictícios ou de teste, execute:**
  ```bash
  php artisan db:seed

- **Rodar o projeto: Para rodar o projeto no ambiente de desenvolvimento, execute:**
  ```bash
  composer run dev

### 5. Rodar os testes
- **Para rodar todos os testes da aplicação, use o comando:**
  ```bash
  php artisan test