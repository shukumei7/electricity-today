# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install mysqli for MySQL database connectivity
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring

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
