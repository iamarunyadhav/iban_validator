# IBAN Validation System

This repository contains both the backend (Laravel) and frontend (Vue.js) for an IBAN Validation web application. The application allows users to register, login, and validate IBAN numbers, storing valid IBANs in a database.

## Technologies Used

- **Backend**: Laravel 10.10
- **Frontend**: Vue.js
- **Database**: MySQL

## Getting Started

These instructions will guide you through setting up and running the project on your local machine for development and testing purposes.

### Prerequisites

Before you begin, ensure you have the following installed:
- Git
- PHP (>= 8.1)
- Composer
- Node.js for npm packages
- MySQL or another relational database system

### Cloning the Repository

Start by cloning this repository to your local machine:

```bash
## Backend

### Inside the project directory, run the following commands
git clone https://github.com/iamarunyadhav/iban_validator.git

cd iban_validator/backends

##use any sql server like xampp or wampp
xampp (phpMyAdmin, MySQL Workbench)

### setup the database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iban   #whatever you want to name your databas
DB_USERNAME=root
DB_PASSWORD=



### install package dependencies
composer install

### Generate key 
php artisan key:generate

###migarate the database
php artisan migrate

##Db seed for default user/admin
php artisan db:seed


## Start backend server
php artisan serve


### This will typically serve your backend on http://localhost:8000

Happy start


## useful commands
php artisan migrate:refresh
php artisan optimize:clear









