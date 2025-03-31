# Spees-Miller Family Website

A WordPress multisite setup with PostgreSQL database using Docker for local development. This setup supports multiple subdomains for family members.

## Subdomains Supported
- www.spees-miller.com (default)
- maxwell.spees-miller.com
- magnus.spees-miller.com
- tycho.spees-miller.com
- drew.spees-miller.com
- kathleen.spees-miller.com

## Local Development Setup

### Prerequisites
- Docker
- Docker Compose

### Getting Started

1. Clone this repository

```bash
git clone <repository_url>
cd spees-miller-www
```

2. Start the Docker containers

```bash
docker-compose up -d
```

3. Access the site at http://localhost:8000

4. Configure WordPress Multisite
   - Complete the initial WordPress setup
   - Navigate to Tools → Network Setup
   - Choose "Sub-domains" installation
   - Complete the setup following the on-screen instructions

5. For local subdomain testing, add the following to your hosts file (/etc/hosts):

```
127.0.0.1 spees-miller.local
127.0.0.1 www.spees-miller.local
127.0.0.1 maxwell.spees-miller.local
127.0.0.1 magnus.spees-miller.local
127.0.0.1 tycho.spees-miller.local
127.0.0.1 drew.spees-miller.local
127.0.0.1 kathleen.spees-miller.local
```

## Managing User Permissions

1. Log in as the Super Admin
2. Create a new site for each family member from the Network Admin dashboard
3. Create user accounts for each family member
4. Assign each user as an Administrator, but only for their own subdomain

## Production Deployment Notes

When deploying to production:

1. Update database credentials in docker-compose.yml
2. Set up proper SSL certificates for all subdomains
3. Configure proper DNS records for each subdomain

## Maintenance

- WordPress and plugin updates can be managed from the Network Admin dashboard
- Database backups should be scheduled regularly
- Docker volumes ensure data persistence between container restarts
