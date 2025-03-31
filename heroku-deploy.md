# Deploying to Heroku with AWS RDS

This guide explains how to deploy your WordPress multisite to Heroku using an AWS RDS MySQL instance for the database.

## Prerequisites

1. Heroku account and Heroku CLI installed
2. AWS account with permissions to create RDS instances
3. Git repository for your project

## Local Setup

Your local setup is already configured with Docker for development. The `wp-config-docker.php` file has been updated to handle both environments.

## Setting Up AWS RDS

1. **Create an RDS MySQL instance:**
   - Log into AWS Console and navigate to RDS
   - Click "Create database"
   - Select MySQL
   - Choose appropriate settings (t2.micro for testing)
   - Set a database name, username, and password
   - Make sure to save these credentials securely
   - Under connectivity, set "Public access" to "Yes" (for Heroku access)
   - Set an appropriate VPC security group that allows inbound traffic on port 3306
   - Create the database

2. **Note your database endpoint and credentials:**
   - After creation, note the endpoint (e.g., `your-db.abcdefghijkl.us-east-1.rds.amazonaws.com`)
   - You'll need the database name, username, password, and endpoint

## Creating a Heroku App

1. **Initialize your Git repository** (if not already done):
   ```
   git init
   git add .
   git commit -m "Initial commit"
   ```

2. **Create a Heroku app:**
   ```
   heroku create spees-miller-www
   ```

3. **Set up Heroku environment variables:**
   ```
   heroku config:set DATABASE_URL=mysql://username:password@your-db-endpoint:3306/database_name
   heroku config:set WP_HOME=https://your-app-name.herokuapp.com
   heroku config:set WP_SITEURL=https://your-app-name.herokuapp.com
   heroku config:set SITE_DOMAIN=your-app-name.herokuapp.com
   ```

4. **Generate and set WordPress security keys:**
   ```
   heroku config:set AUTH_KEY="$(openssl rand -base64 48)"
   heroku config:set SECURE_AUTH_KEY="$(openssl rand -base64 48)"
   heroku config:set LOGGED_IN_KEY="$(openssl rand -base64 48)"
   heroku config:set NONCE_KEY="$(openssl rand -base64 48)"
   heroku config:set AUTH_SALT="$(openssl rand -base64 48)"
   heroku config:set SECURE_AUTH_SALT="$(openssl rand -base64 48)"
   heroku config:set LOGGED_IN_SALT="$(openssl rand -base64 48)"
   heroku config:set NONCE_SALT="$(openssl rand -base64 48)"
   ```

## Deploying to Heroku

1. **Deploy your application:**
   ```
   git push heroku main
   ```

2. **Open your application:**
   ```
   heroku open
   ```

## Setting Up WordPress on Heroku

1. Complete the WordPress installation on Heroku
2. Install and set up the required plugins
3. Configure the multisite settings as needed

## Custom Domain Setup

1. **Add your custom domain to Heroku:**
   ```
   heroku domains:add your-production-domain.com
   heroku domains:add www.your-production-domain.com
   heroku domains:add *.your-production-domain.com
   ```

2. **Update your DNS settings with the Heroku DNS target:**
   - Add a CNAME record for `www` pointing to your Heroku app
   - Add a CNAME record for each subdomain (e.g., `maxwell`, `magnus`)
   - Set up an ALIAS/ANAME record for the root domain (or use DNS provider's forwarding)

3. **Update the Heroku environment variables:**
   ```
   heroku config:set WP_HOME=https://your-production-domain.com
   heroku config:set WP_SITEURL=https://your-production-domain.com
   heroku config:set SITE_DOMAIN=your-production-domain.com
   ```

## File Storage for Production

Since Heroku's filesystem is ephemeral, you should use a service like AWS S3 for permanent file storage:

1. **Install the "WP Offload Media" plugin**
2. **Configure it with your S3 bucket credentials**
3. **Make sure to set up the plugin to handle both uploads and existing files**

## Maintenance Tips

1. **Database backups:** Set up automatic backups for your RDS instance
2. **Scaling:** Adjust Heroku dynos as needed for traffic demands
3. **Monitoring:** Set up Heroku metrics and AWS CloudWatch for monitoring

## Troubleshooting

1. **Check Heroku logs:** `heroku logs --tail`
2. **Database connection issues:** Verify RDS security groups allow Heroku IPs
3. **Multisite problems:** Check the multisite configuration in wp-config.php