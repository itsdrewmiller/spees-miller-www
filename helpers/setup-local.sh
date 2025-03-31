#!/bin/bash

# Create wp-content directories
mkdir -p wp-content/plugins
mkdir -p wp-content/themes
mkdir -p uploads

# Start containers
docker-compose up -d

echo "WordPress is now available at http://localhost:8080"
echo ""
echo "For local subdomain testing, add these entries to your /etc/hosts file:"
echo "127.0.0.1 spees-miller.local"
echo "127.0.0.1 www.spees-miller.local"
echo "127.0.0.1 maxwell.spees-miller.local"
echo "127.0.0.1 magnus.spees-miller.local"
echo "127.0.0.1 tycho.spees-miller.local"
echo "127.0.0.1 drew.spees-miller.local"
echo "127.0.0.1 kathleen.spees-miller.local"
