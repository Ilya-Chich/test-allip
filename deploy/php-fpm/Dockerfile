FROM php:7.4-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y git \
    zip unzip zlib1g-dev libpng-dev libzip-dev lsof libicu-dev libonig-dev \
    supervisor \
    && docker-php-ext-install pcntl zip intl mbstring \
    && pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug intl mbstring

RUN groupadd -g $uid www
RUN useradd -u $uid -ms /bin/bash -g www $user

ENV PATH="$PATH:/opt/www/vendor/bin"
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /opt/www
RUN chown $user ./

USER $user
COPY composer.json composer.lock ./
COPY --chown=$user:www . ./
RUN chmod -R 775 ./composer.lock
#RUN echo $user
#RUN composer update
RUN composer install --no-scripts --no-interaction \
    && \
    composer dump-autoload
