FROM php:7.3.6-fpm-alpine3.9 as build-stage

WORKDIR /var/www

RUN apk add bash && \
    apk add composer

RUN rm -rf /var/www/html

COPY . /var/www
RUN rm -rf vendor
#	composer update && \
#	php artisan key:generate && \
#	php artisan serve --host=0.0.0.0
RUN ln -s public html

EXPOSE 9000
ENTRYPOINT ["php-fpm"]