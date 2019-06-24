FROM php:7.2.2-apache-stretch

# adiciona uma pasta para armazenar as sessions do php dentro de /var/lib/php e aplica permissões para o usuário do apache
ADD . /var/www/html/sigech
RUN mkdir -p /var/lib/php/sessions && \ 
    chown -R www-data:www-data /var/lib/php && \
    apt-get update && \
    apt-get install -y libpq-dev nano iputils-ping telnet && \
    docker-php-ext-install pgsql && \
    docker-php-ext-configure pgsql && \
    apt-get install -y libldb-dev libldap2-dev && \
    ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/local/lib/libldap.so && \
    ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so && \
    docker-php-ext-install ldap && \
    docker-php-ext-configure ldap && \
    apt-get clean &&  \
    rm -rf /var/lib/apt/lists/*
COPY php_session_path.ini $PHP_INI_DIR/conf.d/