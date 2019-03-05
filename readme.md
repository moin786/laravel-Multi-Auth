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

```$ git clone https://github.com/moin786/laravel58multiauth.git```


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


- Seed Database

  ```$ php artisan db:seed```

- Auth scaffolding

  ```$ php artisan make:auth```

### Run the application

  ```$ php artisan serve```


## Built With
* System admin login http://127.0.0.1:8000/login
* Admin login http://127.0.0.1:8000/admin/login
* http://127.0.0.1:8000/manager/login
* http://127.0.0.1:8000/customer/login


## Deail Authentication Route Lists
Route::get('customer/login','Customer\LoginController@showLoginForm')->name('customer.login');
Route::post('customer/login','Customer\LoginController@login');
Route::post('customer/logout','Customer\LoginController@logout')->name('customer.logout');
Route::post('customer/password/email','Customer\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
Route::get('customer/password/reset','Customer\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
Route::get('customer/password/reset','Customer\ResetPasswordController@reset')->name('customer.password.update');
Route::get('customer/password/reset/{token}','Customer\ResetPasswordController@showResetForm ')->name('customer.password.reset');
Route::get('customer/register','Customer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('customer/register','Customer\RegisterController@register');


Route::get('admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login','Admin\LoginController@login');
Route::post('admin/logout','Admin\LoginController@logout')->name('admin.logout');
Route::post('admin/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('admin/password/reset','Admin\ResetPasswordController@reset')->name('admin.password.update');
Route::get('admin/password/reset/{token}','Admin\ResetPasswordController@showResetForm ')->name('admin.password.reset');
Route::get('admin/register','Admin\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('admin/register','Admin\RegisterController@register');


Route::get('manager/login','Manager\LoginController@showLoginForm')->name('manager.login');
Route::post('manager/login','Manager\LoginController@login');
Route::post('manager/logout','Manager\LoginController@logout')->name('manager.logout');
Route::post('manager/password/email','Manager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
Route::get('manager/password/reset','Manager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
Route::get('manager/password/reset','Manager\ResetPasswordController@reset')->name('manager.password.update');
Route::get('manager/password/reset/{token}','Manager\ResetPasswordController@showResetForm ')->name('manager.password.reset');
Route::get('manager/register','Manager\RegisterController@showRegistrationForm')->name('manager.register');
Route::post('manager/register','Manager\RegisterController@register');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('customer/home', 'CustomerController@index')->name('customer.home');
Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('manager/home', 'ManagerController@index')->name('manager.home');