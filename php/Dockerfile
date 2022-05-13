FROM php:5.6-apache
RUN docker-php-ext-install mysql && docker-php-ext-enable mysql
RUN apt-get update && apt-get upgrade -y
RUN a2enmod rewrite