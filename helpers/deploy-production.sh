#!/bin/bash

# This is a sample production deployment script
# Customize this for your specific hosting environment

# Variables
PROD_SERVER="your-production-server.com"
PROD_USER="your-username"
PROD_PATH="/path/to/production/site"

# Ensure we're using production settings
sed -i '' 's/WP_DEBUG\s*,\s*true/WP_DEBUG, false/g' wp-config-docker.php

# Push code to production
echo "Deploying to production..."
rsync -avz --exclude='.git/' \
      --exclude='db_data/' \
      --exclude='uploads/' \
      --exclude='.env' \
      --exclude='docker-compose.yml' \
      ./ "${PROD_USER}@${PROD_SERVER}:${PROD_PATH}"

# Database migration would be handled separately, usually via a backup/restore process

echo "Deployment complete!"
echo "Remember to:"
echo "1. Update database connection settings on the production server"
echo "2. Configure proper DNS records for each subdomain"
echo "3. Set up SSL certificates for all subdomains"
