FROM phpdockerio/php:8.1-fpm
WORKDIR "/boombower"

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        python3 \
        python3-pip \
        python-setuptools \
        supervisor \
        rsyslog \
        ca-certificates \
        file \
        git \
        re2c \
        unzip \
        netcat \
        php8.1-fpm \
        php8.1-common \
        php8.1-cli \
        php8.1-phpdbg \
        php8.1-opcache \
        php8.1-readline \
        php8.1-bcmath \
        php8.1-curl \
        php8.1-gd \
        php8.1-gmp \
        php8.1-imap \
        php8.1-intl \
        php8.1-mbstring \
        php8.1-mysql \
        php8.1-pgsql \
        php8.1-soap \
        php8.1-sqlite3 \
        php8.1-xml \
        php8.1-zip \
        php8.1-imagick \
        php8.1-redis \
        php-sodium \
        php8.1-xdebug \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN set -ex \
    && cd /tmp \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && chmod +x /usr/bin/composer \
    && rm -rf /tmp/*

RUN apt-get update -yq && apt-get upgrade -yq && apt-get install -yq curl git nano
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -yq nodejs build-essential

RUN set -ex \
    && mkdir -p /opt/data \
    && chown www-data:www-data /opt/data \
    && mkdir -p /var/www/html \
    && chown www-data:www-data /var/www/html \
    && mkdir -p /run/php

COPY docker-php-entrypoint /usr/local/bin/

WORKDIR /var/www/html

EXPOSE 80 443 9000

ENTRYPOINT ["docker-php-entrypoint"]

CMD ["php-fpm8.1"]

