# === Image de base ===
FROM php:8.2-apache

# === Variables d'environnement ===
ENV APACHE_DOCUMENT_ROOT /var/www/html

# === Installation des extensions nécessaires ===
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring gd xml \
    && a2enmod rewrite headers

# === Copier tout le projet ===
COPY . /var/www/html/

RUN apt-get update && apt-get install -y unzip git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock /var/www/html/
RUN composer install --no-dev --optimize-autoloader

# === Permissions ===
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# === Exposer le port 80 pour HTTP ===
EXPOSE 80

# === Commande de démarrage ===
CMD ["apache2-foreground"]
