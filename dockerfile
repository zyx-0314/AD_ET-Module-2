FROM php:8.1.28-apache-bullseye

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y entr

WORKDIR /var/www/html

COPY . /var/www/html/

EXPOSE 80

ENV APP_ENV development

RUN if [ "$APP_ENV" = "development" ]; then \
        echo "Setting up development mode..."; \
        echo "display_errors = On" >> /usr/local/etc/php/php.ini; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini; \
    else \
        echo "Setting up production mode..."; \
        echo "display_errors = Off" >> /usr/local/etc/php/php.ini; \
        echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE" >> /usr/local/etc/php/php.ini; \
    fi

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
