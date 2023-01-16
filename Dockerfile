FROM php:7.4-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev git zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app
COPY . /app

RUN composer install
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get install symfony-cli

EXPOSE 8000
CMD ["symfony", "server:start", "--port=8000"]