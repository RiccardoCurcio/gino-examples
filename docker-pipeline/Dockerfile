FROM php:8.1.3-cli

WORKDIR /usr/src/service

COPY ./app /usr/src/service

COPY .env /usr/src/service/.env

RUN apt-get update && \
    apt-get install zip unzip openssl libssl-dev git zlib1g-dev libicu-dev g++ -y

RUN docker-php-ext-install sockets
RUN docker-php-ext-install pcntl

RUN pecl install openswoole \
    && docker-php-ext-enable openswoole \
    && docker-php-ext-enable sockets \
    && docker-php-ext-enable pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer self-update --2

RUN composer install
CMD [ "php", "main.php" ]