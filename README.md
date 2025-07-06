## Revenda Mais - Projeto de testes

### Pré-requisitos
Docker instalado (https://www.docker.com)
Git

Após clonar o projeto, siga as intruções abaixo:

### 1 - Copiando o env
```
cp .env.example .env
```

### 2 - Instalando dependências
```
sail composer install
sail npm install && sail npm run build
```

### 3 - Iniciando os serviços
```
./vendor/bin/sail up -d
```

### 4 - migration e seed
```
./vendor/bin/sail php artisan migrate
./vendor/bin/sail php artisan db:seed
```



## Sobre o projeto
O módulo RevendaMais tem 2 objetivos:
- O primeiro é implementar um endpoint REST para gerenciar os dadso de fornecedores, sejam eles pessoas físicas ou jurídicas. 
- O segundo implementar um facade para APIs de busca de informações de pessoas jurídicas. 

Algumas considerações:
- A opção de isolar em packages é apenas uma decisão de organização e demonstrar o uso da opção. 
- Foi implementado apenas 1 caso de testes, que é a Rule do objeto de validação de documento (CPF/CNPJ)
- Implementei a validação dentro do SupplierController e o ValidateDocument como um objeto separado para demonstrar o uso.
- Não compreendi se a integração com a brasilapi tinha a intenção de completar os dados do cadastro de fornecedores ou apenas retornar os dados para a tela. Acabei optando pela segunda opção.
- Deixei a API aberta. Não teria tempo de implementar o suporte de autenticação. 

O teste esta na pasta padrão. Roda com o comando padrão:
```
./vendor/bin/sail php artisan test
```

## Endpoints

Find:
GET /revendamais/suppliers
```
curl --request GET \
  --url 'http://127.0.0.1/revendamais/suppliers?document=74386567000184&order=name&direction=desc&limit=2'
```

Create:
POST /revendamais/suppliers
```
curl --request POST \
  --url http://127.0.0.1/revendamais/suppliers \
  --header 'Content-Type: application/json' \
  --data '{
	"document": "84719590000105",
	"email": "empresa1@exemplo.com",
	"name": "Empresa S/A",
	"business_name": "Empresa"
}'
```

Get:
GET /revendamais/suppliers/{id}
```
curl --request GET \
  --url http://127.0.0.1/revendamais/suppliers/2
```

Update:
PUT /revendamais/suppliers/{id}
```
curl --request PUT \
  --url http://127.0.0.1/revendamais/suppliers/2 \
  --header 'Content-Type: application/json' \
  --data '{
	"document": "20598877000133",
	"email": "empresa4@exemplo.com",
	"name": "Empresa 2 S/A",
	"business_name": "Empresa 2"
}'
```

Delete:
DELETE /revendamais/suppliers/{id}
```
curl --request DELETE \
  --url http://127.0.0.1/revendamais/suppliers/2
```

Busca de CNPJ:
GET /revendamais/cnpj/{cnpj}
```
curl --request GET \
  --url http://127.0.0.1/revendamais/cnpj/27865757000102
```