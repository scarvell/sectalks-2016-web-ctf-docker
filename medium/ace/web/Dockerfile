FROM php:5.6-apache

# Get packages
RUN \
  apt-get update

RUN docker-php-ext-install mysql

COPY www/ /var/www/html

RUN sed -i 's/localhost/db/' /var/www/html/index.php

