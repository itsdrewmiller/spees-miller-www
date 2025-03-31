<?php
/**
 * Plugin Name: Multisite Port Fix
 * Description: Fixes port numbers in multisite redirects
 * Version: 1.0
 * Author: Claude Code
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Fix port number in redirects for multisite
 */
function fix_multisite_port_redirects($url) {
    if (is_multisite()) {
        // Add port number to URLs that don't have it
        if (defined('PORT_SITE_URL') && PORT_SITE_URL) {
            $domain = DOMAIN_CURRENT_SITE;
            $port = PORT_SITE_URL;
            
            if (strpos($url, $domain) !== false && strpos($url, ":{$port}") === false) {
                $url = str_replace($domain, "{$domain}:{$port}", $url);
            }
            
            // Also fix for subdomains
            $allowed_sites = array('www', 'maxwell', 'magnus', 'tycho', 'drew', 'kathleen');
            foreach ($allowed_sites as $subdomain) {
                $subdomain_url = "{$subdomain}.{$domain}";
                if (strpos($url, $subdomain_url) !== false && strpos($url, ":{$port}") === false) {
                    $url = str_replace($subdomain_url, "{$subdomain_url}:{$port}", $url);
                }
            }
        }
    }
    return $url;
}

// Apply to all redirect and URL functions
add_filter('redirect_canonical', 'fix_multisite_port_redirects');
add_filter('wp_redirect', 'fix_multisite_port_redirects');
add_filter('home_url', 'fix_multisite_port_redirects');
add_filter('site_url', 'fix_multisite_port_redirects');
add_filter('network_home_url', 'fix_multisite_port_redirects');
add_filter('network_site_url', 'fix_multisite_port_redirects');

/**
 * Fix HTTP_HOST for port detection
 */
function fix_http_host_for_port() {
    global $current_blog;
    
    if (is_multisite() && defined('PORT_SITE_URL') && PORT_SITE_URL) {
        if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], ':' . PORT_SITE_URL) === false) {
            $_SERVER['HTTP_HOST'] .= ':' . PORT_SITE_URL;
            if (isset($current_blog->domain) && strpos($current_blog->domain, ':' . PORT_SITE_URL) === false) {
                $current_blog->domain .= ':' . PORT_SITE_URL;
            }
        }
    }
}
add_action('init', 'fix_http_host_for_port', 0);