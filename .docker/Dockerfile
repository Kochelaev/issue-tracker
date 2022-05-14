FROM laradock/php-fpm:latest-7.4

ARG user
ARG uid

RUN set -xe; \
    apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq \
      apt-utils \
      gnupg2 \
      git \
      libzip-dev zip unzip && \
      docker-php-ext-configure zip && \
      docker-php-ext-install zip && \
      php -m | grep -q 'zip'

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g $uid $user
RUN useradd -u $uid -ms /bin/bash -g $user $user

COPY ./issue-tracker /var/www
COPY --chown=$user:$user issue-tracker /var/www
WORKDIR /var/www

USER $user

EXPOSE 9000
