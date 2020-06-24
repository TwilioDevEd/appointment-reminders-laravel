FROM php:7.4

WORKDIR /usr/src/app

RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y git

# Zip for Composer and Dusk
RUN apt-get install -y zip unzip libzip-dev
RUN docker-php-ext-install zip

# Install Node
RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN apt-get install nodejs -y

COPY composer* ./
RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer


COPY . .
RUN make install

EXPOSE 8000

CMD [ "php", "artisan", "serve", "--host=0.0.0.0" ]
