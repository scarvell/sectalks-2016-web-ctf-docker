FROM php:7-apache

RUN apt-get update
RUN apt-get install -y \
  libssl-dev \
  unzip

RUN pecl install mongodb \
&& docker-php-ext-enable mongodb

COPY www/ /var/www/html
