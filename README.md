# JotPot Vulnerable Web Application 

JotPot is a badly coded web application. It was coded in PHP/MySQL. JotPot's main goal is to help security enthusiasts to learn web application security. 


![JotPot MainPage](https://user-images.githubusercontent.com/27926328/66612749-93ad3000-ebcb-11e9-9995-98206b38ad16.png)


JotPot consist of OWASP Top 10 and more. 

+ Injection<br />
    |----HTML Injection (GET)<br />
    |----HTML Injection (POST)<br />
    |----iframe Injection<br />
    |----OS Command Injection Blind<br />
    |----OS Command Injection<br />
    |----PHP Code Injection<br />
    |----SQL Injection (GET)<br />
    |----SQL Injection (POST<br />
    |----SQL Injection - Search From ID (GET)<br />
    |----SQL Injection - Login Form<br />
    |----SQL Injection - Stored - User Agent<br />
    |----SQL Injection - Blind - Boolean Based<br />
    |----Server Site Template Injection (SSTI)<br />
    |----PHP Object Injection
+ Broken Authentication<br />
    |----Broken Authentication Captcha Bypass<br />
    |----Broken Authentication Insecure Login<br />
    |----Broken Authentication Password Attack
- Sensitive Data Exposure 
+ XML External Entities(XXE)<br />
    |----XXE - XML External Entities<br />
    |----XXE Out of Band
+ Broken Access Control<br />
    |----Remote & Local File Inclusion (RFI/LFI)<br />
    |----File Upload
- Misconfiguration
+ Cross Site Scripting (XSS)<br />
    |----XSS - Cross Site Scripting - Reflected - JSON<br />
    |----XSS - Cross Site Scripting - Reflected - Login Form<br />
    |----XSS - Cross Site Scripting - Stored - Blog<br />
    |----XSS - Cross Site Scripting - Stored - User Agent
- Insecure Deserialization
- Componenets with Known Vulnerabilities
- Insufficient Logging & Monitoring
+ Cross Site Reference Forgery(CSRF)<br />
    |----CSRF - Cross Site Reference Forgery - Change Password<br />
    |----CSRF - Cross Site Reference Forgery - Money Transfer
+ Insecure Direct Object Reference (IDOR)<br />
    |----Insecure Direct Object Reference (IDOR)


## Installation for Linux

```commandline

$ systemctl start apache2 or nginx
$ systemctl start mysql

Use the mysqladmin command to create a new database:
$ mysqladmin -u username -p create jotformDB

Lastly, with the new database created, use mysql to import the dump file we created into the new database.
$ mysql -u username -p jotformDB < /path/to/JotPot/database/jotpotDB.sql

$ mysql -u username -p
mysql> CREATE USER 'jotpot'@'localhost' identified with mysql_native_password by 'JotForm1-';
mysql> GRANT ALL PRIVILEGES ON *.* TO 'jotpot'@'localhost';
mysql> FLUSH PRIVILEGES;
mysql> exit;

$ systemctl restart mysql
```



## Configuration PHP

```php
file_uploads = on 
allow_url_fopen = on 
allow_url_include = on 
```



## Credentials

The information will use to login JotPot.
```cli
username = jotform
password = okan
```


# GOOD LUCK HAVE FUN