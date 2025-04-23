# Laravel Docker Setup

Serviços para desenvolvimento em Laravel:

- **PHP-FPM (8.3)**
- **Nginx (Alpine)**
- **MySQL (8)**
- **Docker Compose**

---

## 📦 Comandos a serem executados

```
cd infra
sudo docker-compose up -d --build
sudo docker-compose exec app composer install
cp app/.env.example app/.env
sudo docker-compose exec app php artisan key:generate
sudo docker-compose exec app php artisan migrate
```
