<h1 align='center'>
  📌 Teste-Dev-PHP Instructions
</h1>

<p align='center'>
  Project developed as part of the selection process for the position of Fullstack Developer,
with a focus on showing knowledge of the required technologies.
</p>

<div align="center">

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Postgres](https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Swagger](https://img.shields.io/badge/-Swagger-%23Clojure?style=for-the-badge&logo=swagger&logoColor=white)
![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

</div>


### 📋 Requirements

-   PHP v8.3

### To run the test on your machine, following the steps:

- Copy the .env.example file and Installing Composer Dependencies:

```bash
    cp .env.example .env && composer update
```

- Define database password in .env:

```
    DB_PASSWORD=password
```

-   You can configure a shell alias

```bash
    alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

- Run the system using Docker and Sail:

```bash
    sail up -d
```

- Create a new key for the application:

```bash
    sail artisan key:generate
```

- Run Migrations with Seeders:

```bash
    sail artisan migrate:fresh --seed
```

### 📦 Development Tools

> **Obs:** To run the tests, comment out the **DB_DATABASE=api** variable in the .env and remove the **DB_DATABASE=testing** comment.

-   Run Pest tests

```bash
    sail artisan test
```

-   Run Pest tests with Coverage

```bash
    sail artisan test --coverage
```

-   Generate doc Swagger

```bash
    sail artisan l5-swagger:generate
```

### API endpoints

> **Obs:** For a better documentation of the api, [swagger](https://github.com/DarkaOnLine/L5-Swagger) was used, use the route on the browser: [link](http://localhost/api/documentation) to view more details.

**Endpoint Search CNPJ in BrasilAPI:** `DELETE /api/brasilapi/{cnpj}` **Obs:** Return details about CNPJ. <br/>

**Endpoint List Suppliers:** `GET /api/v1/suppliers` **Obs:** Returns a list of all suppliers and is possible use filters params (orderByDirection, orderByField, company, cnpjcpf, email, paginate). <br/>
**Endpoint List Only Supplier:** `GET /api/v1/suppliers/{id}` **Obs:** Return a supplier by id in JSON. <br/>
**Endpoint Create New Supplier:** `POST /api/v1/suppliers` **Obs:** Create a new supplier. <br/>
**Endpoint Update Supplier:** `PUT /api/v1/suppliers/{id}` **Obs:** Update a supplier by id. <br/>
**Endpoint Delete Supplier:** `DELETE /api/v1/suppliers/{id}` **Obs:** Delete a supplier by id. <br/>


### Project structure

- `./app/DTO`: Files to transfer data between layers of an application in an organized and efficient manner following design patterns.
- `./app/Http/Controllers`: Files to handle incoming HTTP requests, send them to the correct service and return the appropriate responses.
- `./app/Http/Requests`: Files that are responsible for validating each input received by the request, for the post and put methods, with different rules for each.
- `./app/Models`: Files that serve as an abstraction layer for interacting with these tables.
- `./app/Providers`: Files with the initialization of the interfaces used by the localization methods.
- `./app/Repositories`: Files with the interfaces and technique used to abstract the data access logic, separating it from the business logic, with the methods for each resource, one of which can be defined for each ORM, so that it is not dependent only on eloquent.
- `./app/Services`: Files with classes that encapsulate specific functionality for each method, communicating between controller and repository.
- `./Docker`: Initialization files needed for docker containers.
- `./storage/api-docs`: Json file with settings for the swagger.
- `./storage/logs`: Files with the exceptions for each method in the repository, used for evaluations.
- `./tests/App/`: Automated test.
