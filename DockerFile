# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia el código del proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80 para la aplicación web
EXPOSE 80

# Comando para ejecutar Apache en segundo plano
CMD ["apache2-foreground"]
