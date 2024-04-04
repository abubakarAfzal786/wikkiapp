# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy composer.json and composer.lock to the working directory
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Run Composer scripts
RUN composer dump-autoload --optimize

# Expose ports
EXPOSE 8989

# Start Apache server
CMD ["apache2-foreground"]
