FROM php:8.2-apache

# Enable Apache mod_rewrite if needed (optional)
RUN a2enmod rewrite

# Copy everything to the web root
COPY . /var/www/html/

# Set proper permissions (optional)
RUN chown -R www-data:www-data /var/www/html
