FROM wordpress:6.7.2

# Copy custom configuration file
COPY wp-config-docker.php /usr/src/wordpress/wp-config-docker.php

# Copy custom .htaccess for subdomain support
COPY .htaccess /usr/src/wordpress/.htaccess

# Set ownership for WordPress files
RUN chown -R www-data:www-data /usr/src/wordpress