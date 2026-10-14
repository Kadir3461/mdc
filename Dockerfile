FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Mailversand (SMTP) via msmtp
RUN apt-get update \
    && apt-get install -y --no-install-recommends msmtp ca-certificates \
    && rm -rf /var/lib/apt/lists/*
COPY docker/mail.ini /usr/local/etc/php/conf.d/mail.ini
COPY docker/entrypoint.sh /usr/local/bin/mdc-entrypoint.sh
RUN sed -i 's/\r$//' /usr/local/bin/mdc-entrypoint.sh \
    && chmod +x /usr/local/bin/mdc-entrypoint.sh

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

ENTRYPOINT ["mdc-entrypoint.sh"]
CMD ["apache2-foreground"]
