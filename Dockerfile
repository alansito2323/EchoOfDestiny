FROM php:8.0-apache

# Instala la extensión mysqli
RUN docker-php-ext-install mysqli

# Cambia la configuración de Apache para escuchar en el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Establece un ServerName para evitar la advertencia
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia los archivos del proyecto en la carpeta raíz del servidor
COPY . /var/www/html/

# Expón el puerto 8080 para que Railway pueda acceder a él
EXPOSE 8080
