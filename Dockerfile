FROM php:apache

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN a2enmod rewrite

CMD php artisan serve --host=0.0.0.0 --port=80

