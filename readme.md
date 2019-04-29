# Laravel Multi authentication using Laravel core Authentication system

## Getting Started
These instructions will get you how to build Laravel Multiple authentication using various guards and its existing authentication process, you may free to create your own way, but laravel way is secure and well tested and you can try this way to move yourself into next level.

### Prerequisites
What things you need to install the software.

* Git.
* PHP.
* Composer.
* A webserver like Nginx or Apache.

### Install
Clone the git repository on your computer

```https://github.com/moin786/laravel-Multi-Auth.git```


You can also download the entire repository as a zip file and unpack in on your computer if you do not have git

After cloning the application, you need to install it's dependencies. 

```
$ cd laravel58
$ composer install
```


### Setup
- When you are done with installation, copy the `.env.example` file to `.env`

  ```$ cp .env.example .env```


- Generate the application key

  ```$ php artisan key:generate```


- Add your database credentials to the necessary `env` fields

- Migrate the application

  ```$ php artisan migrate```


- Seed Database ### This will create default system user into main users table

  ```$ php artisan db:seed```

- Auth scaffolding

  ```$ php artisan make:auth```

### Run the application

  ```$ php artisan serve```

### Note: 
```
Inside route folder analyze web.php file then Chek your auth.php file inside config folder, then you can understand how to setup guard.
Analyse your Controller folder of Http folder inside app folder, you will find morethan two folder of users type, and into those         folders files are exact copy of Auth folder, so open up each file and examine how it is done? . 
Login into default root user, root user can create admin, then login into admin user, admin user can create manager, manager and admin can manage customer, you can register customer from registration link in outside. try with every and each user type then you will realize Multi guard authentication procedure. 
```

### Author

[Mohammed Minuddin(Peal)](https://moinshareidea.wordpress.com)

keep always smile :)
