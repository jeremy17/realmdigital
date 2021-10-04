# realmdigital
Realm Digital Simple Practical Assessment

### Setup
To enable SSL for HTTP Client:

```
Download "cacert.pem" from: https://curl.haxx.se/docs/caextract.html

Place this file in C:\ssl

Add the following two lines to php.ini

under [curl]:
curl.cainfo=C:/ssl/cacert.pem
under [openssl]:
openssl.cafile=C:/ssl/cacert.pem
```

### Prerequisites
PHP >= 7.4.16
with the following extensions enabled:
```
extension=curl
extension=fileinfo
extension=gd2
extension=gettext
extension=mbstring
extension=exif      ; Must be after mbstring as it depends on it
extension=openssl
extension=pdo_mysql
```

MySQL >= 8.0.26

### Laravel .env file
Copy ```.env.dev``` to ```.env```

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
