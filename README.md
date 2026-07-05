# Acadex by Zorfts Technologies - School management system 

This is a plain PHP site (not Laravel — no composer/artisan), but Valet serves those fine. Here's how to run it:

## 1. Serve it with Valet [https://laravel.com/docs/13.x/valet]


```cd /Users/1y54h/Documents/GitHub/school_management_system```
```valet link school-management```

Then open http://school-management.test. (If you've already run valet park in ~/Documents/GitHub, it's already being served as http://school_management_system.test — no link needed.)

## 2. Start MySQL and create the database

The app connects via action_php/database.php:3 to MySQL at localhost as root with an empty password, database name spring:


```brew install mysql```        # if you don't have it
``` brew services start mysql ```
```mysql -u root -e "CREATE DATABASE IF NOT EXISTS spring;"```

If your local root user has a password, either update it in the database.php files (note there are several copies — one per module under admistration/*/action_php/database.php) or set root's password to empty locally.

## 3. Entry points

Public site: http://school-management.test/ (index.php)
Admin modules live under admistration/ — e.g. http://school-management.test/admistration/principal/