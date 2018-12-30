FROM php:5.6-apache

# Get packages
RUN \
        apt-get update 

RUN apt-get -y install fontconfig

RUN docker-php-ext-install mysql

COPY www/ /var/www/html
COPY files/ /root

# Patch db host
RUN sed -i 's/localhost/db/' /var/www/html/db.php
RUN sed -i 's/localhost/db/' /root/xss-auditor.php

RUN chmod +x /root/start.sh /root/phantomjs
CMD ["/root/start.sh"]
