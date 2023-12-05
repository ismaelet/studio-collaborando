# Use the official PHP image with Apache
FROM php:apache

# Set working directory
# WORKDIR /var/www/html

# Install the database
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable .htaccess rewrite
RUN a2enmod rewrite

# Install system dependencies
# RUN apt-get update
# RUN apt-get install -y libzip-dev
# RUN apt-get install -y unzip
# RUN docker-php-ext-install zip

# Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files into the container
# COPY . /var/www/html

# Install Laravel dependencies
# RUN composer install --no-interaction --no-plugins --no-scripts

# Set permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
