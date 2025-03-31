# Development Guidelines for Claude Code

## Commands
- Start environment: `docker-compose up -d`
- Stop environment: `docker-compose down`
- Clean restart: `docker-compose down -v && docker-compose up -d`
- Setup local environment: `./helpers/setup-local.sh`
- Deploy to production: `./helpers/deploy-production.sh`
- Access site at http://localhost:8080
- MySQL available on port 3307

## Build & Test
- No specific test runners identified
- WordPress multisite configuration enabled

## Code Style
- Follow WordPress coding standards: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/
- Use environment variables for configuration
- Debug mode enabled in local environment only
- Error handling: Log errors but don't display (`WP_DEBUG_DISPLAY=false`)
- Limit post revisions to 5 versions
- Admin file editing is disabled (`DISALLOW_FILE_EDIT=true`)
- Automatic updates disabled (`AUTOMATIC_UPDATER_DISABLED=true`)
- Security: Always sanitize input with appropriate WordPress functions

## Project Structure
- Docker-based WordPress environment with MySQL
- Dockerfile extends WordPress 6.7.2 image
- docker-compose.yml defines WordPress and MySQL services
- wp-config-docker.php handles WordPress configuration
- helpers/ contains setup and deployment scripts