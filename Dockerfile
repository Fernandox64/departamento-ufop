FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
        unzip \
    && docker-php-ext-install pdo mbstring xml zip bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN { \
      echo 'display_errors=Off'; \
      echo 'display_startup_errors=Off'; \
      echo 'error_reporting=E_ALL & ~E_DEPRECATED & ~E_STRICT'; \
      echo 'log_errors=On'; \
      echo 'default_charset=UTF-8'; \
      echo 'upload_max_filesize=60M'; \
      echo 'post_max_size=65M'; \
    } > /usr/local/etc/php/conf.d/zz-local.ini

RUN { \
      echo '<VirtualHost *:80>'; \
      echo '    DocumentRoot /var/www/html/public'; \
      echo '    <Directory /var/www/html/public>'; \
      echo '        AllowOverride All'; \
      echo '        Require all granted'; \
      echo '    </Directory>'; \
      echo '    # Imagens/anexos enviados pelo painel admin ficam em /storage/uploads.'; \
      echo '    # Nunca deve ser possivel executar PHP vindo dali, mesmo se algum'; \
      echo '    # arquivo malicioso passar pela validacao de upload (defesa em profundidade).'; \
      echo '    <LocationMatch "^/storage/.*\.(php[0-9]?|phtml|pht|phar)$">'; \
      echo '        Require all denied'; \
      echo '    </LocationMatch>'; \
      echo '</VirtualHost>'; \
    } > /etc/apache2/sites-available/000-default.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && mkdir -p storage/app/private/content storage/app/public/uploads storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && php artisan storage:link \
    && chown -R www-data:www-data storage bootstrap/cache
