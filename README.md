# Distribuidora Frutagro API
API creada para ser consumida por la aplicación web de la Distribuidora Frutagro. Desarrollado con el framework Laravel 7 y protegida con Laravel Passport para su autenticación a través de access token. 

## Dependencias

- **Apache HTTPD** >= 2.4
- **PHP** >= 7.2.5
- **MySql** >= 5.7
- **Composer**

## Instalación

Siga los pasos a continuación para instalar y configurar la aplicación.

**Clonar repositorio**

`git clone https://github.com/Jonlle/frutagro-api.git`

**Instalar dependencias**

`composer install`

**Archivo `.env`**

Copie el contenido del archivo `.env.example` en el archivo `.env` y modificar los siguientes datos para la conexión con la BD.

```
DB_HOST=127.0.0.1 //hostname de la DB
DB_PORT=3306 //puerto de la BD
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=password
```

**Ejecutar migración y seeding**

Ejecute el siguiente comando para migrar las tablas e inicializar la BD con los datos predeterminados.

`php artisan migrate --seed`

**Instalar Passport**

`php artisan passport:install`

## API EndPoints

**URL API:** `http://localhost:8000/api/v1`

| Verb     |  URI             | Descripción      |
| -------- | ---------------- | ---------------- |
| `POST`   | `/auth/register` | Register         |
| `POST`   | `/auth/login`    | Login            |
| `POST`   | `/auth/logout`   | Logout           |
| `GET`    | `/auth/user`     | Show user auth   |
| -------- | **Users**        | ---------------- |
| `GET`    | `/users`         | Show all user    |
| `POST`   | `/users`         | Create user      |
| `GET`    | `/users/{user}`  | Show single user |
| `PUT`    | `/users/{user}`  | Update user      |
| `DELETE` | `/users/{user}`  | Delete user      |
