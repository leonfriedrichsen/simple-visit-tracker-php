# Simple PHP Visit Tracker

This is a library for PHP to track visits on your website. My goal was to develop a visit tracker where I know exactly what data is stored and where it is stored. Also, no personal data is stored, and no cookies are used, which means you don't need a privacy policy, cookie banner and other consent that is usually required for other analytics tools in the EU.

## Installation

#### 1. Download the library
Download this repository and add it to your project.

#### 2. Setup your SQL database
You need to create a new SQL database with two tables:

The ```userVisits``` table ...

```
| Name   | Type        | Extra          |
| ------ | ----------- | -------------- |
| ID 🔑  | int(11)     | AUTO_INCREMENT |
| page   | varchar(64) |                |
| date   | date        |                |
| userIp | varchar(64) |                |
```

... and the ```totalVisits``` table.
```
| Name   | Type        | Extra          |
| ------ | ----------- | -------------- |
| ID 🔑  | int(11)     | AUTO_INCREMENT |
| page   | varchar(64) |                |
| date   | date        |                |
| visits | int(11)     |                |
```

#### 3. Add your credentials to the ```config.php``` file
To be able to access your database you, have to add your credentials in the ```config.php``` file.
```php
<?php
$host_name = 'host_name'; # <-- here
$database = 'database';   # <-- here
$user_name = 'user_name'; # <-- here
$password = 'password';   # <-- here

$link = new mysqli($host_name, $user_name, $password, $database);

if ($link->connect_error) {
  die('<p>Verbindung zum MySQL Server fehlgeschlagen: '. $link->connect_error .'</p>');
}

```

#### 4. Add the ```countVisit``` function to your webpages
To finally be able to count your visits, you need to rename your HTML files to PHP files and add the following at the top:

```php
<?php
require('src/visit-counter.php');

VisitCounter::countVisit('example.php'); # <-- the parameter is the name of the page that will be saved in the database
?>

```


## Example
```php
<?php
require('src/visit-counter.php');

VisitCounter::countVisit('example.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
</head>

<body>

    <h1>Body Heading</h1>
    <p>Body paragraph.</p>

</body>

</html>
```

## Licence

This library is licensed under the MIT License. See the [LICENSE](https://github.com/leonfriedrichsen/simple-visit-tracker-php/blob/main/LICENCE) file for the full license.