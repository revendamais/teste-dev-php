
# Comandos uteis:

sudo docker-compose up -d 
cp .env.example .env
php artisan key:generate
php artisan migrate

# testes
vendor/bin/phpunit


---

# 🧠 Estrutura de Diretórios - Laravel + Repository pattern

Este projeto segue os princípios de **DDD (Repository Desing pattern)** aplicados à arquitetura do Laravel, com foco exclusivo em **API**.

A separação por **regra de negócio** (e não por tipo técnico) promove modularidade, testabilidade, escalabilidade e manutenibilidade.

---

## 📁 Estrutura Geral

```

app/
├── Main/
├── Services/
├── Models/
├── Http/
├── Rules/
├── Providers/
├── Rules/
```

---

## 🧩 Detalhamento por pasta

### 📦 `app/Main/`

Contém a **lógica de negócio pura**.

#### Exemplo:
```

app/
├── Main/
│   └── Fornecedor/
│       ├── Actions
│           ├── FornecedorCriarAction
│           ├── FornecedorListarAction
│           ├── FornecedorAtualizarAction
│           ├── FornecedorRemoverAction
│       ├── Exception
│           ├── FornecedorException
│       ├── Repository
│           ├── FornecedorRepositoryInterface
│           ├── FornecedorRepository
│
├── Http/
│   ├── Controllers/Api/V1/FornecedoresController.php
│   └── Requests/FornecedorRequest.php
```

---

### ⚠️ `Exceptions/`

Manipulando exeções globais no bootstrap/app.php


## 🛠️ Vantagens dessa arquitetura

- 📦 **Isolamento de domínios**
- 🧱 **Organização modular e escalável**

---


---

## 🧪 Testabilidade

- Testes implementados no diretório tests/

---


