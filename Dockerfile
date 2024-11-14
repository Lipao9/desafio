# Use a imagem do PHP com FPM
FROM php:8.2-fpm

# Instale extensões do PHP necessárias
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Instale o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crie e defina o diretório da aplicação
WORKDIR /var/www

# Copie o projeto para dentro do container
COPY . .

# Instale as dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Ajuste as permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Porta que o PHP-FPM expõe
EXPOSE 9000

# Comando de inicialização do container
CMD ["php-fpm"]
