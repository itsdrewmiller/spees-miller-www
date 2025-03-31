# .gitignore for WordPress on Heroku

For deploying WordPress to Heroku, you'll want to add a `.gitignore` file in your repository to avoid committing unnecessary files while ensuring Heroku gets everything it needs.

Create a file named `.gitignore` with this content:

```
# WordPress core (in case someone runs composer update in the site's directory)
/wp-admin/
/wp-includes/
/wp-*.php
/index.php
/xmlrpc.php
/license.txt
/readme.html

# WordPress content that's dynamically created
/wp-content/uploads/
/wp-content/upgrade/
/wp-content/ai1wm-backups/
/wp-content/cache/
/wp-content/cache/
/wp-content/debug.log

# WP config files that should not be in version control
wp-config.php

# Ignore OS generated files
.DS_Store
Thumbs.db

# Ignore editor folders
.idea/
.vscode/

# Ignore node dependency directories
node_modules/

# DO NOT IGNORE:
# composer.lock - Heroku requires this file
# wp-config-docker.php - This is our custom config
# .htaccess - Important for multisite setup
```

## Important Notes for Heroku Deployment

1. **DO NOT ignore `composer.lock`**: Heroku requires this file to guarantee reliable installation of dependencies.

2. **DO NOT ignore your custom configuration file** (`wp-config-docker.php`) as it contains environment detection for Heroku.

3. **DO NOT ignore `.htaccess`** or any other files necessary for WordPress multisite.

4. **Consider adding WordPress Core to your repository**: For a Heroku deployment, it can be practical to include WordPress core files in your git repository, even though this is not a typical best practice for WordPress development.