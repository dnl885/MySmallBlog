
# MySmallBlog

A small blog application made in Laravel with Bootsrap, and JQuery, using CKEditor for editing and Dropzone.js for image uploading.

# Setup

## 1. Installing backend dependencies

```composer install```

## 2. Installing frontend dependencies and compiling them

- Install: ```npm install```
- Compile: ```npm run dev``

## 3. Setting up database

 1. Create a database named **my-small-blog**
 2. Run the migrations: ```php artisan migrate```
 3. Run the seeders: ```php artisan db:seed --class=RoleSeeder``` and ```php artisan db:seed --class=AdminSeeder``` (always run the RoleSeeder first, otherwise the second seeder will exit with the error: ```'Admin role does not exist. Run the RoleSeeder first!'```)

Now that you have set up the database, you can log in as admin with the following email/password combination:

Email: admin@admin.com

Password: p@$$w0rd0123

## 4. Start server
```php artisan serve```

## 5. Receiving mails
The mailing function was tested with devmail but feel free to change the mail settings in the .env file.
