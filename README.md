# Proman
Proman: A PHP web project and a final assignment for a PHP course, part of my Computer Science bachelor's degree studies at Vaasa University of Applied Sciences. This application focuses on project and task management, utilizing PDO for database interaction with MariaDB.

## Features

* **User management:** Create user to be able to log in and out, recover or change password.
* **Project management:** User can create, list, edit and delete projects. User can also search for project based on project name.
* **Task management:** User can create, list, edit and delete tasks on projects. User can merge images and comments on tasks.
* **API- testing software:** User has access to software to test API connection.
* **Automated functionalities:** The system will also automatically adds tasks to google calendar and send notification emails.

## Tecnologies
* **PHP** 
* **MariaDB**
* **PDO**
* **HTML, CSS**
* **JavaScript**

## Install

Follow these steps to use PROMAN on local development enviroment

### Requirements

* PHP
* MariaDB/MySQL
* Web-host with PHP
* Git

### Step-By-Step

**Clone repository**
Open terminal and clone project to folder of own choosing:
```bash
git clone https://github.com/W3lh0/Proman.git
cd Proman
```

**Database settings**
Project includes `model` folder. In this folder you need to create a file: `config.php`. **This file not included for security reasons**
Create `model/config.php` and add code:
```php
<?php
$host = "[your_database_host]";
$username = "[your_user_name]";
$password = "[your_password]";
$dbname = "[your_database_name]";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
?>
```

**Database creation and populating**
Open URL that points to `install.php`-file. For example:
`http://localhost/[projekt_path]/data/install.php`
This script creates required database tables and inserts mock data in to them.

**Start application**
After database is set, you can navigate to home page:
`http://localhost/[projektin_path]/public/index.html`

---

### Developer

* **Name:** Ilkka Ratilainen
* **Student number:** e2101506
* **GitHub:** https://github.com/W3lh0