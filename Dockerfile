# Étape 1 : Image de base PHP avec FPM
FROM php:8.2-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Créer le dossier de travail
WORKDIR /var/www/html

# Copier tous les fichiers Laravel dans le conteneur
COPY . .

# Installer les dépendances Laravel sans les devs
RUN composer install --no-dev --optimize-autoloader

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Mettre en cache la config et les routes
RUN php artisan config:cache && php artisan route:cache || true

# Exposer le port (Render utilisera $PORT automatiquement)
EXPOSE 8080

# Lancer Laravel avec le port Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT
