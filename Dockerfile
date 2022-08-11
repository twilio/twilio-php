FROM php:7.4

RUN apt-get update -y && apt-get install -y zip

RUN mkdir /twilio
WORKDIR /twilio
ENV PATH="vendor/bin:$PATH"

COPY src src
COPY tests tests
COPY composer* ./

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install --prefer-dist
