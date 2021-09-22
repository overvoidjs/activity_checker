FROM php:7.2-fpm-alpine


#Какие команды запустить при установке контейнера
RUN apk update \
    && apk add  --no-cache git mysql-client curl libzip-dev \
    && docker-php-source extract \
    && docker-php-ext-enable opcache \
    && docker-php-source delete \
    && docker-php-ext-install pdo_mysql opcache zip \
    && rm -rf /tmp/*

CMD ["php-fpm", "-F"]

WORKDIR /var/www

EXPOSE 9000
