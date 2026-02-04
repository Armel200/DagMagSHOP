FROM php:8.3-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir dossier de travail
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donner les permissions
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port
EXPOSE 8000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
