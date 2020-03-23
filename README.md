Bawsala is an opensource platform for storing locations and managing it, users can interact with places adding reviews and rate them. 
you can access **Bawsala** live on [here](http://104.248.145.132)

## INSTLATION


step 1 : install depandancies 

```
composer install
```
step 2 : create your configuration file

```
cp .env.example .env
```
once you create configuration file you should edit it to use your database connection and Google map key.

step 3 : migrate and seed your database

```
php artisan migrate --seed
```

now it's all done and you can serve the app on your local machine using the command

```
php artisan serve
```
**note**

you can access the admin dashboard using the default admin user:
 
 email: admin@baylsaan.com
 
 pass: admin12345678
 