ARG PHP_VERSION=8.3.10
FROM php:${PHP_VERSION}-cli

ARG SANITIZER=""
ENV SANITIZER="${SANITIZER}"

RUN mkdir -p /usr/src/pecl-ev
WORKDIR /usr/src/pecl-ev

COPY . .
RUN ./ci/setup-php-docker.sh
RUN ./ci/build.sh
RUN chmod +x run-tests.sh

ENV NO_INTERACTION=1
CMD ["./ci/test.sh"]

# vim: ft=dockerfile
