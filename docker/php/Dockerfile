FROM surnet/alpine-wkhtmltopdf:3.16.2-0.12.6-full AS wkhtmltopdf
FROM php:8.2-fpm-alpine3.18 AS prod
ENV APP_ENV=prod
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN apk add --no-cache \
        bash \
		acl \
		fcgi \
		file \
		gettext \
		git \
        yarn \
        libstdc++ \
        libx11 \
        libxrender \
        libxext \
        libssl1.1 \
        ca-certificates \
        fontconfig \
        freetype \
        ttf-droid \
        ttf-freefont \
        ttf-liberation \
        nodejs \
        npm \   
	;
RUN set -eux; \
    install-php-extensions \
        	apcu \
        	intl \
    		opcache \
        	zip \
            redis \
            pdo_sqlite \
            pdo_mysql\
            amqp \
            ldap \
            xsl \
            ;
# wkhtmltopdf copy bins from ext image
COPY --from=wkhtmltopdf /bin/wkhtmltopdf /bin/libwkhtmltox.so /bin/
	    
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/var/www/.composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ARG UID=1000
ARG GID=1000

RUN addgroup -g ${GID} laravel || true \
    && adduser -u ${UID} -G laravel -h /var/www -D laravel || true

RUN mkdir -p $COMPOSER_HOME/cache \
    && chown -R ${UID}:${GID} $COMPOSER_HOME \
    && chmod -R 775 $COMPOSER_HOME

WORKDIR /var/www/laravel



FROM prod AS dev

ENV APP_ENV=dev















