FROM php:5.6-apache

# Get packages
RUN \
	apt-get update 

RUN \
	apt-get install -y zlib1g-dev

RUN docker-php-ext-install zip

# Copy webroot
COPY www/ /var/www/html

# Copy flag to it's location
COPY __FLAG__ /

# Fix permissions on uploads
RUN chmod 777 /var/www/html/uploads
