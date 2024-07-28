FROM webdevops/php-nginx:8.3-alpine

WORKDIR /app

ENV requirements "openssl-dev libsodium-dev libpng-dev zlib-dev libzip-dev icu-dev $PHPIZE_DEPS"
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV WEB_DOCUMENT_ROOT /app/public

RUN apk add --update --no-cache vim tree mlocate busybox-extras psmisc shadow icu libpng libzip $requirements \
    && pecl install igbinary \
    && docker-php-ext-install pdo_mysql gd zip \
    && docker-php-ext-enable igbinary \
    && docker-php-source extract \
    && docker-php-source delete \
    && apk del $requirements



COPY project/back .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer install --optimize-autoloader \
    && composer dump-autoload --classmap-authoritative \
    && docker-service disable ssh \
    && docker-service disable cron \
    && docker-service disable dnsmasq \
    && docker-service disable postfix \
    && mkdir -p /app/var/cache/prod && mkdir -p /app/var/log && chmod -R 777 /app/var/
