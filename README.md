# Teste Dev PHP

Este projeto utiliza Docker para criar um ambiente completo com Laravel, PHP, Nginx e MySQL.

## Pré-requisitos

- Docker e Docker Compose instalados na máquina.

## Como Iniciar o Projeto

### 1. Clone o repositório

```bash
git clone <URL-DO-REPOSITÓRIO>
cd laravel-docker
```

### 2. Suba os containers

Execute o comando abaixo para construir e subir todos os containers:

```bash
docker-compose up -d --build
```

### 3. Configuração do Laravel

- Durante o build, o container `app` executa o `composer install` para instalar as dependências do Laravel.
- Certifique-se de que as configurações do banco de dados no arquivo `.env` do Laravel estão de acordo com as definições do `docker-compose.yml`:

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

## Estrutura do Projeto

- **Dockerfile**: Define a imagem e as dependências para o ambiente PHP com Laravel.
- **docker-compose.yml**: Configura os serviços necessários (app, webserver e database).
- **docker/nginx/default.conf**: Arquivo de configuração do Nginx para servir o projeto Laravel.

---

Agora você tem um ambiente completo para desenvolver com Laravel utilizando Docker. Divirta-se programando!