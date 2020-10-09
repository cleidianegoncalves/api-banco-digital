
# Api Banco Digital
> Projeto que simula operações de um banco digital

Api que simula operações de um banco digital, utilizando framework Laravel e arquitetura GraphQl.

## Instalação
### Pré requisitos

Para executar o projeto é ncessário ter:

```
Docker Desktop (ou docker tools)
```

### Instalando

Comece clonando o repositório:
```
$ git clone https://github.com/cleidianegoncalves/api-banco-digital.git
```

Copie o .env-example e renomeie para .env

Acesse a pasta do projeto através do PowerShell e execute o comando
```
docker-compose up -d
```

Após o contêiner ser iniciado execute o comando para abrir um terminal no webserver:

```
docker exec -it banco-digital-webserver execute sh
```

Dentro do terminal, você estará na pasta `/app`, instale as dependências do projeto com o comando:

```
composer install
```

Após a instalação, vamos migrar a base de dados:

```
php artisan migrate
```

Crie uma conta para acessar (conta: `54321` e saldo: `2000`)

```
php artisan db:seed
```

Pronto, nossa API estará rodando. Para verificar o funcionamento das rotas, temos o Graphql Playground dentro do projeto, para acessá-lo digite a seguinte url em um navegador web:
```
http://localhost:8080/graphql-playground
```

Agora será possível testar nossas mutations e queries da api:

```
query {
  saldo(conta: 54321)
}

mutation {
  depositar(conta: 54321, valor: 200) {
    conta
    saldo
  }
}

mutation {
  sacar(conta: 54321, valor: 140) {
    conta
    saldo
  }
}
```

## Executando Teste Unitario

Para testar a aplicação utlizamos o PHPUnit, através do comando:

```
vendor/bin/phpunit
```
