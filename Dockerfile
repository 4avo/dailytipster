FROM php:8.2-apache
# Updates via the apt tool.
RUN apt-get update && apt-get install -y \ 
nodejs \ 
npm \ 
libmcrypt-dev \
libmagickwand-dev --no-install-recommends \
&& pecl install imagick
WORKDIR /var/www/html
# Install PHP extensions and dependencies
RUN docker-php-ext-install pdo_mysql
# Enable Apache mod_rewrite module
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
