# Usa la imagen oficial de PHP con Apache
FROM php:8.0-apache

# Cambia la configuración de Apache para escuchar en el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copia los archivos del proyecto en la carpeta raíz del servidor
COPY . /var/www/html/

# Expón el puerto 8080 para que Railway pueda acceder a él
EXPOSE 8080
