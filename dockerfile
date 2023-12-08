FROM gitpod/workspace-full

USER gitpod

RUN sudo apt-get update && sudo apt-get install -y git

# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install mysqli for MySQL database connectivity
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite for CodeIgniter's .htaccess files
RUN a2enmod rewrite

# Copy CodeIgniter project files into the Docker image
COPY ./ /var/www/html/

# Change the ownership of the application files to the www-data user (Apache user)
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 for the Apache server
EXPOSE 80
