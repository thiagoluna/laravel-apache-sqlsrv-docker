FROM ubuntu:18.04
LABEL maintainer="bjverde@yahoo.com.br"

ENV DEBIAN_FRONTEND noninteractive

#Install update
RUN apt-get update && apt-get -y upgrade

#Install facilitators
RUN apt-get -y install locate mlocate wget apt-utils

RUN apt-get -y -q install apache2 php libapache2-mod-php php-cli

#PHP Install CURl
RUN apt-get -y -q install curl php-curl

## ------------- PHP Development ?? ------------------
RUN cp -v /etc/php/7.2/apache2/php.ini /etc/php/7.2/apache2/php.ini.old
RUN cp -v /usr/lib/php/7.2/php.ini-development /etc/php/7.2/apache2/php.ini

RUN apt-get -y -q install php-pear php-dev 

ENV ACCEPT_EULA=Y

RUN curl -s https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl -s https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get install -y -q --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update

# install MSODBC 17
RUN apt-get -y -q --no-install-recommends install msodbcsql17 

RUN apt-get -y install unixodbc unixodbc-dev
RUN apt-get -y install gcc g++ make autoconf libc-dev pkg-config


##------------ Install Drive 5.2 for SQL Server -----------

RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv

#For PHP CLI
RUN echo extension=pdo_sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini
RUN echo extension=sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/20-sqlsrv.ini

#For PHP WEB
RUN echo "extension=pdo_sqlsrv.so" >> /etc/php/7.2/apache2/conf.d/30-pdo_sqlsrv.ini
RUN echo "extension=sqlsrv.so" >> /etc/php/7.2/apache2/conf.d/20-sqlsrv.ini

COPY ./www /var/www/laravel
RUN rm -rf /var/www/html
RUN ln -s /var/www/laravel/public/ /var/www/html
RUN chmod -R 777 /var/www/laravel/storage/*

## ------------- Finishing ------------------
RUN apt-get clean

#Creating index of files
RUN updatedb

EXPOSE 80
CMD apachectl -D FOREGROUND