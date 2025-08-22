Laravel 12

Commands to run first:

composer install

npm install

Commands to install packages:

Livewire: composer require livewire/livewire

Bootstrap: npm install bootstrap @popperjs/core sass

Bootstrap icon: npm i bootstrap-icons

run npm install and npm run dev after installing bootstrap


Libraries:

Sortable.js: <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

Alpine.js: <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

Run: 
Start apache and mysql on XAMPP (PHP 8.2.*)

npm run dev (vite) and php artisan serve

Deploy: 
push to github -> sign up/ sign in to sevalla.com -> create new application (from the github repo) -> create new database (mysql) -> connect database with application -> get all database variables (host, user, password, database name, etc.) -> config env variable (import env from local then config to prodution mode) -> migrate database using web terminal.
