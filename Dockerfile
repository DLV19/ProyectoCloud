FROM php:8.2-cli

# Instala extensiones necesarias (como mysqli para MySQL)
RUN docker-php-ext-install mysqli

# Copia el contenido del proyecto al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Expone el puerto requerido por Render
EXPOSE 10000

# Comando para iniciar el servidor PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
