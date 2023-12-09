# Use the official PHP 8.1 image with Apache
FROM php:8.1-apache

# Install dependencies for the PHP extensions
RUN apt-get update && apt-get install -y libicu-dev libonig-dev

# Install the PHP extensions
RUN docker-php-ext-install mysqli intl mbstring

# Enable Apache mod_rewrite for CodeIgniter's .htaccess files
RUN a2enmod rewrite

# Copy CodeIgniter project files into the Docker image
COPY ./ /var/www/html/

# Change the ownership of the application files to the www-data user (Apache user)
RUN chown -R www-data:www-data /var/www/html/

# Set the environment variable for the document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Replace the default document root in the apache configuration files
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80 for the Apache server
EXPOSE 80
