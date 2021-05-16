Este projeto é uma aplicação web com controle de acesso de usuários e controle de tarefas do usuário.

Foram usados neste projeto:

1 - Laravel
2 - Vue.js
3 - Vuex
4 - MySQL
5 - Redis
6 - Docker and Docker Compose
7 - Bootstrap V4

Preparando o ambiente:

```
$ git clone https://github.com/romarioarruda/laravel-vue-spa

$ composer install

$ npm install

$ docker-compose up -d
```

Rodando migrations da base de dados no container docker

```
$ docker-compose exec laravel_spa_php bash

$ php artisan migrate
```

Abrindo o projeto no browser

```
$ http://localhost:8081
```
