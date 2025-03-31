# WordPress Multisite with Subdomains Setup Guide

This guide provides step-by-step instructions for setting up a WordPress multisite installation with subdomains, so that each family member can manage their own site (maxwell.example.com, magnus.example.com, etc.) with appropriate permissions.

## Initial Setup

1. **Go to** http://localhost:8080 and complete the basic WordPress installation
2. **Login** to the WordPress admin dashboard at http://localhost:8080/wp-admin

## Enable Multisite Feature

1. **Add these lines** to wp-config-docker.php (just before "That's all, stop editing"):
   ```php
   /* Multisite */
   define('WP_ALLOW_MULTISITE', true);
   ```

2. **Save the file** and refresh your WordPress admin dashboard

3. **Go to** Tools > Network Setup

4. **Select** "Sub-domains" installation option 

5. **Complete** the network setup by following the on-screen instructions

## Configure the Network

After enabling multisite, WordPress will provide instructions to:
1. Update wp-config.php with network settings
2. Create/update .htaccess file with rewrite rules

**Note**: We're using the docker mount for wp-config-docker.php instead of wp-config.php

## Map Domains Locally (for development)

Add these entries to your hosts file:
- On Mac/Linux: Edit `/etc/hosts` with sudo
- On Windows: Edit `C:\Windows\System32\drivers\etc\hosts` as Administrator

```
127.0.0.1 localhost
127.0.0.1 spees-miller.local
127.0.0.1 www.spees-miller.local
127.0.0.1 maxwell.spees-miller.local
127.0.0.1 magnus.spees-miller.local
127.0.0.1 tycho.spees-miller.local
127.0.0.1 drew.spees-miller.local
127.0.0.1 kathleen.spees-miller.local
```

## Create Sites for Family Members

1. **Go to** My Sites > Network Admin > Sites > Add New

2. **Create sites** for each family member:
   - Site Address: maxwell (Subdomain)
   - Site Title: Maxwell's Site 
   - Admin Email: (use your email for now)

3. **Repeat** for each family member

## Set Up User Accounts & Permissions

1. **Go to** Network Admin > Users > Add New

2. **Create accounts** for each family member

3. **Assign users** to their sites:
   - Go to each site's dashboard in Network Admin
   - Add the appropriate user with the "Administrator" role
   - Ensure users only have Admin role on their own sites

## Testing and Usage

1. **Log out** of the admin account

2. **Have each user log in** at their subdomain (e.g., http://maxwell.spees-miller.local:8080/wp-admin)

3. **Verify** that each user:
   - Can only edit their own site
   - Can't access Network Admin
   - Can't access other family member sites

## Advanced Setup (for production)

When moving to production, you'll need to:
1. Update domain names to your actual domain
2. Configure DNS records for each subdomain 
3. Set up SSL certificates for all subdomains