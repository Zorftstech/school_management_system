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

If your local root user has a password, either update it in the database.php files (note there are several copies — one per module under administration/*/action_php/database.php) or set root's password to empty locally.

## 3. Entry points

Public site: http://school-management.test/ (index.php)
Admin modules live under administration/ — e.g. http://school-management.test/administration/principal/

## Easy Access Links

Super Admin - [http://school-management.test/administration/super_admin/super_admin_login.php]

Director - [http://school-management.test/administration/director/director_login.php]

Principal - [http://school-management.test/administration/principal/principal_login.php]

Academic Officer - [http://school-management.test/administration/academic_officer/academic_officer_login.php]

Admin Officer - [http://school-management.test/administration/admin_officer/admin_officer_login.php]

Exam Officer - [http://school-management.test/administration/exam_officer/exam_officer_login.php]

Finance Officer - [http://school-management.test/administration/finance/finance_officer_login.php]

Online Exam (Exam Officer) - [http://school-management.test/administration/online_exam/exam_officer_login_form.php]

Online Exam (Student) - [http://school-management.test/administration/online_exam/online_exam_login_form.php]

Pupil Online Exam (Exam Officer) - [http://school-management.test/administration/pupil_online_exam/exam_officer_login_form.php]

Pupil Online Exam (Pupil) - [http://school-management.test/administration/pupil_online_exam/pupil_online_exam_login_form.php]

Pupil Attendance (Formaster) - [http://school-management.test/administration/pupil_attendance/formaster_login_form.php]

Student Attendance (Formaster) - [http://school-management.test/administration/student_attendance/formaster_login_form.php]

