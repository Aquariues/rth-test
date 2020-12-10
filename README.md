# rth-test

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
