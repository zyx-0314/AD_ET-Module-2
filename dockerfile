# Base image with PHP 8.1 and Apache
FROM php:8.1.28-apache-bullseye

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install the `entr` tool for live reloading
RUN apt-get update && apt-get install -y entr

# Set the working directory
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html/

# Expose port 80 for Apache
EXPOSE 80

# Set environment variables for development mode
ENV APP_ENV development

# Conditional configuration based on environment variable
# You can use shell commands or conditional statements in your Dockerfile.
# The script below adjusts the Apache configuration based on the APP_ENV variable.

# Development mode configuration
RUN if [ "$APP_ENV" = "development" ]; then \
        echo "Setting up development mode..."; \
        # Enable error display for development
        echo "display_errors = On" >> /usr/local/etc/php/php.ini; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini; \
        # Add any other development configurations (e.g., xdebug, composer) here
        # RUN pecl install xdebug && docker-php-ext-enable xdebug
    else \
        echo "Setting up production mode..."; \
        # Disable error display for production
        echo "display_errors = Off" >> /usr/local/etc/php/php.ini; \
        echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE" >> /usr/local/etc/php/php.ini; \
        # Add any other production configurations (e.g., caching, optimizations) here
    fi

# Copy the entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Define the entrypoint script to run the application
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
