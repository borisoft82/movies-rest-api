
# Movies API Project

The Movie API project represents a database of movies that can be created by the user. The user has the possibility to register, log in and log out within the application. In addition to the above, the user can create a genre and movie and search the database of movies according to predefined parameters.
CORS and token are implemented on each API endpoint. Users have the possibility to manipulate only their articles of films, ie. they do not have the possibility to manipulate the articles of other users' films within their account


## Installation

Install.: 
XAMPP (https://www.apachefriends.org/), 
Composer (https://getcomposer.org/download/), 
Git Bash (https://git-scm.com/downloads) 

Create MySQL database in phpMyAdmin then open you CLI and run these commands one by one:

```bash
  git clone <project>

  composer install

  cp .env.example .env 
  
  (put your db credentials inside .env)

  php artisan jwt:secret

  php artisan migrate --seed

  php artisan serve


```
    
## Running PHPUnit Tests

To run tests, run the following command

```bash
  php artisan test

  or

  ./vendor/bin/phpunit
```
## Running Postman Tests

Refresh and seed database running the following command:

```bash
  php artisan migrate:fresh --seed
```
Download Postman from https://www.postman.com/ then install and import environment and collections files from:

```bash
  ./z-postman-files
```
Inside your Postman activate <b>Movies API Reporting</b> environment and copy/paste the Bearer token (you will take token from response by user logging via collection <b>Auth -> Login user</b>) inside token variable row in the column <b>Current value</b> like below and <b>Save</b>:

```bash
  Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2xvZ2luIiwiaWF0IjoxNjg4MDM1MjgyLCJleHAiOjE2ODgwMzg4ODIsIm5iZiI6MTY4ODAzNTI4MiwianRpIjoiNFJwNUd1dGdJTWMzWjJ1MiIsInN1YiI6IjExIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.uf7QsEz_vrreHbx-wZ4LE7Y0w0Mpu-25FK7K9jn6J1I
```
Don't forget to register user, before logging, via collection <b>Auth -> Register user</b> request.

Now you can test every request from the collections just by clicking <b>Send</b> request button.

## Notice

I approached the creation of the project in a very simple way because it seems to me that there was no need to apply more complex solutions for this type of task. In any case, the project could be done by applying the following principles: Repositories for CRUD (the pattern has been created but not implemented), Exceptions and Error Handlers, Services, Docker container (PHP, Composer, Nginx, PostgreSQL), Roles and Permissions, Event Listeners, ...