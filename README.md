Teams-players-laravel-vue -- Laravel 5 example
-------------------------------------------------

Football teams & players application with database CRUD (Create, Read, Update and Delete) functionalities and pagination using Laravel 5.3 and vue2.js 

This app illustrates a "one-to-many" Laravel models relationship, i.e: a team may have 0, 1 or > 1 players but

a player must belong to only one team. 

For more infos:

https://laravel.com/docs/5.4/eloquent-relationships#one-to-many

http://itsolutionstuff.com/post/laravel-5-and-vue-js-crud-with-pagination-example-and-demo-from-scratchexample.html


Installation
--------------

type git clone https://github.com/KB-WEB-DEVELOPMENT/Teams-players-laravel-vue.git projectname to clone the repository
    
type cd projectname
    
type composer install
    
type composer update
    
copy .env.example to .env
    
type php artisan key:generateto regenerate secure key
    
if you use MySQL in .env file :

set DB_CONNECTION

set DB_DATABASE

set DB_USERNAME

set DB_PASSWORD

