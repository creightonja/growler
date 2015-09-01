# _Growler_

#### An app for adding, finding, and reviewing local bottled beer and the stores that sell bottled beer.

##### _By Adam Won, Brian Borealis, Jason Creighton, Marvin Nikijuluw, and Steve Smietana_

## Description

_This app allows users to add bottled beer and the stores that sell bottled beer to a database.  Beers, stores, and users can be created, found, updated, and deleted.  ._

## Setup

- Run a php server from the /web directory
- Download [composer](https://getcomposer.org/) to automatically load the following dependancies:
 - Silex - a microframework for organizing our project.
 - Twig - a templating engine to automate HTML work
 - PHPUnit - a testing framework to verify our functions are working properly.

In the project folder, use the command `composer install` in the terminal to run composer.

These instructions assume you are using mysql for your database.
To set up a new database, run the following commands from terminal:
```
mysql.server start
mysql -uroot -proot
CREATE DATABASE shoes;
USE shoes;
CREATE TABLE brands (name VARCHAR (255), id serial PRIMARY KEY);
CREATE TABLE stores (name VARCHAR (255), id serial PRIMARY KEY);
CREATE TABLE brands_stores (brand_id INT, store_id INT, id serial PRIMARY KEY);
```
Access your database at localhost:8080/phpMyAdmin or whatever directory you have setup.

If you'd like to use a sample database, select import in phpMyAdmin and choose
the included database 'shoes.sql.zip'.

If you wish to run the test functions, create a copy of the database named shoes_test and enter `./vendor/bin/phpunit tests` in the terminal from the project folder.

## Technologies Used

PHP, Silex, Twig, PHPUnit, mysql

### Legal

Copyright (c) 2015 **_Steve Smietana_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
