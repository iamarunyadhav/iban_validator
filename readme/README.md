
# BACKEND
# iban_validator# IBAN Validation System

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

## Start backend server
php artisan serve


### This will typically serve your backend on 

Note : http://127.0.0.1:8000   #(run this port as default frontend .env config is not working)

Happy start


## useful commands
php artisan migrate:refresh
php artisan optimize:clear
```

## FRONTEND



# IBAN Validation System - Frontend

This is the frontend part of the IBAN Validation System built with Vue.js. It provides a user interface for registering, logging in, and validating IBAN numbers.

## Technologies Used

- Vue.js
- Vue Router for SPA navigation
- Axios for making HTTP requests
- Bootstrap for responsive and modern UI components

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development purposes.

### Prerequisites

Before you begin, ensure you have the following installed:
- Node.js (LTS version recommended)
- npm (comes with Node.js)

### Cloning the Repository

Start by cloning the frontend repository to your local machine:

```bash
git clone https://github.com/iamarunyadhav/iban_validator.git
cd iban_validator/frontend

## create  .env file
use config.js

# endpoint
VUE_APP_API_ENDPOINT=http://localhost:8000/api/v1

## Project Setup

```sh
npm install
npm run serve

```

## build 
```sh
npm run build
```







