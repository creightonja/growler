# _Growler_

#### An app for adding, finding, and reviewing local bottled beer and the stores that sell bottled beer.

##### _By Adam Won, Brian Borealis, Jason Creighton, Marvin Nikijuluw, and Steve Smietana_

## Description

_This app allows users to add bottled beer and the stores that sell bottled beer to a database.  Beers, stores, and users can be created, found, updated, and deleted.  ._

## Setup


- Download [composer](https://getcomposer.org/) to automatically load the following dependancies:
 - Silex - a microframework for organizing our project.
 - Twig - a templating engine to automate HTML work
 - PHPUnit - a testing framework to verify our functions are working properly.
 - Start apache server
 - Ensure that the mysql port is set correctly in the app file and start mysql.
 - Import the growler.sql database and set a clone to growler_test if testing.
 - Run a php server from the /web directory

In the project folder, use the command `composer install` in the terminal to run composer.


If you wish to run the test functions, create a copy of the database named shoes_test and enter `./vendor/bin/phpunit tests` in the terminal from the project folder.

## Technologies Used

PHP, Silex, Twig, PHPUnit, mysql

### Legal

Copyright (c) 2015 **_By Adam Won, Brian Borealis, Jason Creighton, Marvin Nikijuluw, and Steve Smietana_**

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
