1)Larave version is 7.x
2)Cashier stripe version 12.17.2
3)Pages are user login, registration, products, checkout , my orders pages

Deployment Steps:
1)composer install
2)Update stripe keys in .env file
3)run php artisan key:generate
4)run php artisan config:cache 
5)run php artisan config:clear 
6)run php artisan migrate
7)run php artisan db:seed
8)run php artisan serve
