# realmdigital
Realm Digital Simple Practical Assessment

### Setup
To enable SSL for HTTP Client:

Download "cacert.pem" from: https://curl.haxx.se/docs/caextract.html
Place this file in C:\ssl
Add the following two lines to php.ini

under [curl]:
curl.cainfo=C:/ssl/cacert.pem

unser [openssl]:
openssl.cafile=C:/ssl/cacert.pem

### Create Database
```
mysql> CREATE SCHEMA `realmdigital` DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_general_ci ;
C:\> php artisan migrate
```

### To run service
```
C:\> php artisan app:sendbirthdayemails
```

### Notes
Install an SMTP server on localhost
