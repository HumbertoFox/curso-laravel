<div align="center">

<a href="https://portfolio-react-betofoxnet-info-projects.vercel.app/"><img src="https://github.com/user-attachments/assets/8e37b052-5c84-4c25-bcb3-56f36e875326" width="150px"/></a>

# BetoFoxNet_Info

</div>


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<p align="center"><a href="https://vitejs.dev" target="_blank" rel="noopener noreferrer"><img src="https://vitejs.dev/logo.svg" width="110" alt="Vite logo"></a></p>

<p align="center">
  <a href="https://npmjs.com/package/vite"><img src="https://img.shields.io/npm/v/vite.svg" alt="npm package"></a>
  <a href="https://nodejs.org/en/about/previous-releases"><img src="https://img.shields.io/node/v/vite.svg" alt="node compatibility"></a>
  <a href="https://github.com/vitejs/vite/actions/workflows/ci.yml"><img src="https://github.com/vitejs/vite/actions/workflows/ci.yml/badge.svg?branch=main" alt="build status"></a>
  <a href="https://pr.new/vitejs/vite"><img src="https://developer.stackblitz.com/img/start_pr_dark_small.svg" alt="Start new PR in StackBlitz Codeflow"></a>
  <a href="https://chat.vitejs.dev"><img src="https://img.shields.io/badge/chat-discord-blue?style=flat&logo=discord" alt="discord chat"></a>
</p>

## Deploy Laravel + Vite + BootStrap + Railway

## About Laravel + Vite

### Como fazer Deploy do Github Laravel no Railway adicionar as variáveis de ambiente no App e no Banco de Dados Railway:

<div align="center">

### <img src="https://github.com/user-attachments/assets/aede684a-b961-448a-96c8-7a64b2750550" width="450px"/>

### <img src="https://github.com/user-attachments/assets/f21d02fd-4101-413d-a321-99f38ddc3711" width="450px"/>

### <img src="https://github.com/user-attachments/assets/2f04f20b-4293-4fe0-a90a-1664af61ed1b" width="450px" />

### <img src="https://github.com/user-attachments/assets/04386811-2328-4704-9180-9834e67b022a" width="450px"/>

<div align="start">

Adicionar as variáveis de ambiente do .env local como mostra na imagem abaixo e fazer as substituição a seguir:

</div>

### <img src="https://github.com/user-attachments/assets/72b73678-aced-4209-998a-3491f1b8b223" width="450px"/>

### <img src="https://github.com/user-attachments/assets/b6f3046b-aea6-4c3b-84b8-8602a9fe48f3" width="450px"/>

### <img src="https://github.com/user-attachments/assets/fa7f0c04-376f-4a6d-ad9b-e49898ed5f4e" width="450px"/>


<div align="start">

Para garantir que as URLs utilizem sempre HTTPS adicione este if no /app/Providers/AppServiceProvider.php

register

```php
  if ($this->app->environment('production', 'staging')) {
    URL::forceScheme('https');
  }
```

Substituir os valores das seguintes variáveis:

APP_ENV="local" por APP_ENV="production"

DB_HOST por PGHOST<br>
DB_PORT por PGPORT<br>
DB_DATABASE por PGDATABASE<br>
DB_USERNAME por PGUSER<br>
DB_PASSWORD por POSTGRES_PASSWORD<br>


Em seguida copiar o conteúdo da variável de ambiente DATABASE_PUBLIC_URL do Railway para o .env local.

E inserir os valores nas variáveis no .env local para fazer o migration no Banco de Dados no Railway.

DB_HOST<br>
DB_PORT<br>
DB_DATABASE<br>
DB_USERNAME<br>
DB_PASSWORD<br>

Após a copia dos valores corretos usar o seguinte comando:

```bach
php artisan migrate

```

Após fazer a mogration publique o App como mostro nas imagens abaixo:

</div>

### <img src="https://github.com/user-attachments/assets/f1ccba37-9dc3-4dfa-9dd3-d7bc973cd5e4" width="450px"/>

### <img src="https://github.com/user-attachments/assets/6315b3e5-1a8a-40a2-b01f-24fca5c2ca78" width="450px"/>

### <img src="https://github.com/user-attachments/assets/c5554800-0223-48c0-a48c-48588e513efc" width="450px"/>

<div align="start">

Por padrão a porta do App esta como 8080 e quando publicamos é 9000, altere-a para 8080, pronto o seu App esta no ar.

</div>

</div>

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Comando para Implementação

### Local

composer i

npm i

### Local e Deploy

php artisan migrate

php artisan db:seed


## Desenvolvido em:

<div>

  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vscode/vscode-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vitejs/vitejs-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-plain.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-plain.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/railway/railway-original.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/axios/axios-plain.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-plain.svg" width="30px"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/npm/npm-original-wordmark.svg" width="30px"/>
  
</div>