# SLOTEGRATOR test

## Requirements
- PHP 7.3 or higher
- Apache or other web-server
- MySQL or other SQL database
- Composer

## Installation
- Clone or copy this repo to the new project directory
- Go to command line (cmd), change to the project directory and run `composer install` to install all the dependencies
- Change database settings in the `config/db.php` file
- Change email (SMTP) configuration in the `config/web.php` file
- Create tables needed for the system by running the following migration command:
```shell
php yii migrate
```

## Testing the system
- Start application from your local webserver, or use the prepared demo-version:
http://test11.fotomas.ru/basic/web/
- Register, login and then explore the system functionality using **YOUR ACCOUNT** menu
- Technical requirements for the application can be found in the **About** article
- Run the bulk transfer of money prizes by running command
```
php yii bulk/transfer-money X
```
where X - the size of bulk (the number of money prizes which will be transfer to the users bank accounts). 
Money prizes will be transferred by using "FIFO" principle.

## TODOS
- Functional and unit tests
- Admin interface
- Emulation of money transfer using RESTFUL Api
- Some code refactoring