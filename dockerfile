# Usa imagem oficial do PHP com Apache
FROM php:8.3-apache

# Instala dependências
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia o projeto para o container
WORKDIR /var/www/html
COPY . .

# Instala dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Permissões de pastas
RUN chmod -R 775 storage bootstrap/cache

# Configura Apache para servir da pasta public/
RUN a2enmod rewrite
RUN echo "<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

EXPOSE 80
