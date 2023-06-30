### Step install and run this project

**First - Run command :**
```
composer install
```

**And then, run script :**
```
npm run install
```

**And then, please edit variable on .env following your database configuration on local :**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**And then, run command for clear all configuration :**
```
php artisan cache:clear
php artisan config:cache
php artisan config:clear
```

**And then, run command for migrate all to database :**
```
php artisan migrate
```

**And then, run command for create automatically first user admin :**
```
php artisan db:seed
```

**Finally, you need run both command together**
```
php artisan serve
npm run dev
```
