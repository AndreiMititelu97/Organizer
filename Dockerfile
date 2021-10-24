# syntax=docker/dockerfile:1
FROM php:7.4.25-apache
RUN apt-get update
RUN docker-php-ext-install mysqli mysqlnd pdo pdo_mysql
RUN docker-php-ext-enable mysqli
