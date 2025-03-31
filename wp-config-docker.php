<?php
/**
 * WordPress Configuration File
 *
 * This file contains the basic settings for WordPress, including database connection
 * parameters and environment-specific configurations for local and production environments.
 */

// ** Environment detection ** //
// Local development with Docker uses environment variables
// Production on Heroku uses DATABASE_URL
$dev_mode = !getenv('DATABASE_URL');

// ** Database settings ** //
if ($dev_mode) {
    // Docker local environment
    define('DB_HOST', getenv('WORDPRESS_DB_HOST'));
    define('DB_USER', getenv('WORDPRESS_DB_USER'));
    define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD'));
    define('DB_NAME', getenv('WORDPRESS_DB_NAME'));
} else {
    // Production environment (Heroku with AWS RDS)
    $db_url = parse_url(getenv('DATABASE_URL'));
    define('DB_HOST', $db_url['host'] . ':' . (isset($db_url['port']) ? $db_url['port'] : '3306'));
    define('DB_USER', $db_url['user']);
    define('DB_PASSWORD', $db_url['pass']);
    define('DB_NAME', trim($db_url['path'], '/'));
}

// Database character set & collation
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Configure table prefix
$table_prefix = getenv('WORDPRESS_TABLE_PREFIX') ?: 'wp_';

// ** Site URL settings ** //
if ($dev_mode) {
    // Local development
    // WordPress will auto-detect the correct URL
} else {
    // Production URLs (Heroku)
    define('WP_HOME', getenv('WP_HOME'));
    define('WP_SITEURL', getenv('WP_SITEURL'));
    
    // Force SSL in production
    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $_SERVER['HTTPS'] = 'on';
    }
}

// Debug mode configuration
define('WP_DEBUG', $dev_mode); // Enable in development, disable in production
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

// Set sane limits for post revisions
define('WP_POST_REVISIONS', 5);

// Disable automatic updates
define('AUTOMATIC_UPDATER_DISABLED', true);

// Disable file edits in admin
define('DISALLOW_FILE_EDIT', true);

// In production, disable file modifications (plugin/theme updates)
if (!$dev_mode) {
    define('DISALLOW_FILE_MODS', true);
}

/* Multisite */
define('WP_ALLOW_MULTISITE', true);

/* Authentication Unique Keys and Salts */
define( 'AUTH_KEY', '5f%x[>+Wq`r /w{,8}:GjrG5Jw:P,)_VJWX>(9$5+QnfFSmAqLLUVg@%0+_#n G|' );
define( 'SECURE_AUTH_KEY', '+iw[4>(3A@110yb !+Md8!oCQ)bvr_j;O(m/h4HRJuyGH.@`MHAD?D`PsK.8?6ln' );
define( 'LOGGED_IN_KEY', 'Ve7-Cvmq3HjZNPHg4)BF/X_]r`fiY?#<;axeM!|| ;c8Cpg3V,+Yd5EdqD.^!2R,' );
define( 'NONCE_KEY', ',(%<>YH[z+*ui$IYim.3+?R|}l_?dh7Xy3YgNV~AFx#-YZv>-j#1Rouq9eHeO9MN' );
define( 'AUTH_SALT', 'I,4t!%JV5N9ZynQ6ND)vAkMw5c;f%fp9B9/%yvqe)D)Zb7{cWX=4|2,/H%h/LzE9' );
define( 'SECURE_AUTH_SALT', '! L0<F@TNijox&n(hMDnJZ`$O/*vLW(KR7>/s6XwJiXBsW--E<1rd(}HTimJD8V%' );
define( 'LOGGED_IN_SALT', 'c.7#Mo63xmS}T}|bjG/ZZ/+3.4W{@V![XjfySEv|OX+F0DOHX-}CT!k*KSaEX_vG' );
define( 'NONCE_SALT', '7-Z,!z+`Z*$Rn0GtnBhVM.=O+P,)0>=%A1pH!JJ2woKBSQ.E!R6RdjUPl/ =o7DU' );

// Multisite configuration (added by WordPress Network setup)
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
define( 'DOMAIN_CURRENT_SITE', $dev_mode ? 'spees-miller.local' : getenv('SITE_DOMAIN') );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

// Port handling for dev environment
if ($dev_mode) {
    // If we're in dev mode, add the port to the domain
    define('PORT_SITE_URL', '8080');
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';