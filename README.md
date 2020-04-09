**Bawsala** is an opensource platform based on [Laravel](https://laravel.com) framework for storing locations and managing it, users can interact with places adding reviews and rate them. 
you can access **Bawsala** live on [here](http://104.248.145.132)

## SERVER REQUIREMENTS

**Bawsala** has a few system requirements.

Below is the list which you will need to make sure your server meets the following requirements:

* PHP >= 7.2.5
* BCMath PHP Extension
* Ctype PHP Extension
* Fileinfo PHP extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* GD PHP Extension

## INSTLATION
**Bawsala** utilizes Composer to manage its dependencies. So, before using Bawsala, make sure you have Composer installed on your machine

* Install depandancies 

```
composer install
```
* Setup your Enviroment(.env) file

```
cp .env.example .env
```
once you create configuration file you should edit it to use your database connection and Google map key.

* Migrate and seed your database

```
php artisan migrate --seed
```

Now it's all done and you can serve the app on your local machine using the command

```
php artisan serve
```
**Note**

You can access the admin dashboard using the default admin user:
 
 email: admin@baylsaan.com
 
 pass: admin12345678
 