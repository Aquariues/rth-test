# rth-test

Quach Hoang Long  - Test of Robust Tech House

a simple blog web that you can CRUD your blog from web or from api
visitor can only Read blog

clone source from git : https://github.com/Aquariues/rth-test.git

create database(mysql)

create .env file like .env.example

run:

cp .env.example .env

setup your .env file

install composer and nodejs

run:

composer install
npm install
php artisan migrate
php artisan db:seed

you can import postman file to see api example (please change USER-TOKEN in header with your TOKEN you see when you login)
