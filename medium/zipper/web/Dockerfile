FROM php:5.6-apache

# update
RUN \
	apt-get update && apt-get -y upgrade

# Install packages
RUN apt-get -y install \
		zlib1g \
		zlib1g-dev \
		unzip

RUN docker-php-ext-install zip

COPY www/ /var/www/html

RUN chmod -R 777 /var/www/html/archives
