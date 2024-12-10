# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    && docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && apt-get clean

# Enable required Apache modules
RUN a2enmod rewrite

# Set the working directory in the container
WORKDIR /var/www/html

# Copy project files into the container
COPY . /var/www/html

# Expose port 80 for HTTP
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]
