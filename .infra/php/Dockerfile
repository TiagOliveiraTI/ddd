FROM php:8.3-cli AS builder

WORKDIR /var/www

RUN apt-get update && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"
    
RUN mv composer.phar /usr/local/bin/composer

RUN mkdir app

FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN rm -rf /var/www/html

COPY --from=builder /var/www .

RUN ln -s public html

RUN chown -R www-data:www-data /var/www

RUN apk add --no-cache --virtual .build-deps unzip curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apk del .build-deps

EXPOSE 9000

CMD [ "php-fpm" ]