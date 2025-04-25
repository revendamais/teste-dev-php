# Laravel Docker Setup

Serviços docker para desenvolvimento em Laravel:

-   **PHP-FPM (8.3)**
-   **Nginx (Alpine)**
-   **MySQL (8)**
-   **Docker Compose**

---

## Software obrigatório

-   [docker](https://docs.docker.com/engine/install/)
-   [docker compose](https://docs.docker.com/compose/install/)

## 📦 Comandos a serem executados

```bash
cd infra
sudo docker-compose up -d --build
sudo docker-compose exec app composer install
cp app/.env.example app/.env
sudo docker-compose exec app php artisan key:generate
sudo docker-compose exec app php artisan migrate
```

---

> Dependendo de como o docker foi instalado o comando **docker-compose** pode ser subtituido por **docker compose**

> Caso apareça algum problema de permissão ao acessar o sistema rode os comandos:

```bash
sudo docker compose exec -it app sh
chmod 755 -R *
exit
```

---

Assim que finalizado o migrate o sistema estará disponivel em http://127.0.0.1:8000 (caso a porta 8000 não esteja disponivel trocar a mesma no arquivo docker-compose.yml)
