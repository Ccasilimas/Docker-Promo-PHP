# Utilizar la imagen oficial de PHP con Apache
FROM php:7.4-apache

# Instalar extensiones necesarias de PHP
RUN docker-php-ext-install mysqli

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80 para acceder a la aplicación web
EXPOSE 80
