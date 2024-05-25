# Use the official PHP image with Apache
FROM php:apache

# Install the database
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install the intl extension for currency formatting
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl

# Enable .htaccess rewrite
RUN a2enmod rewrite
