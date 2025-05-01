# Laravel Docker Setup

Serviços docker para desenvolvimento em Laravel:

-   **PHP-FPM (8.3)**
-   **MySQL (8)**
-   **Redis**
-   **MailHog**

Voçê pode escolher entre 2 tipos de servidor web

-   **Nginx (Alpine)**
-   **Caddy** (Possui suporte automatico a SSL local)

---

## Software obrigatório

-   [docker](https://docs.docker.com/engine/install/)
-   [docker compose](https://docs.docker.com/compose/install/)

## 📦 Comandos a serem executados

Escolha entre o nginx ou caddy para a criação do serviço

```bash
cd container
sudo PWD=${PWD} HTTP_PORT=8000 docker-compose -f docker-compose.<caddy|nginx>.yml up -d --build
sudo docker exec laravel_php composer install --no-dev --optimize-autoloader
cp ./app/.env.example ./app/.env
sudo docker exec laravel_php php artisan key:generate
sudo docker exec laravel_php php artisan migrate
```

---

> Dependendo de como o docker foi instalado o comando **docker-compose** pode ser subtituido por **docker compose**

> Caso apareça algum problema de permissão ao acessar o sistema rode os comandos:

```bash
sudo docker exec -it laravel_php sh
chmod 755 -R *
exit
```

> Foram encontrados erros de permissão usando o WSL tanto nos arquivos como na parte de network. É recomendado rodar em uma maquina linux.

---

Assim que finalizado o migrate o sistema estará disponivel em [http://app.localhost:8000](http://app.localhost:8000).

Outros endereços que podem ser utilizados.

-   [PHPMyAdmin](http://phpmyadmin.localhost:8000)
-   [MailHog](http://mailhog.localhost:8000)
