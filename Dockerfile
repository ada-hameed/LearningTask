FROM php:8.1-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy CodeIgniter files
COPY . /var/www/html/

WORKDIR /var/www/html/

# Permissions (optional)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Allow .htaccess rewrite
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf
