#!/bin/bash

# Docker development environment setup script for Retromat
# Re-runnable and safe to use

set -e
set -u
trap 'echo ""; echo "ERROR: Setup failed at line $LINENO - check the command above"; exit 1' ERR

# Configuration
ENV_LOCAL_FILE="backend/.env.local"
ENV_LOCAL_CONTENT='DATABASE_URL=mysql://root:PaSsWoRd@db:3306/retromat?serverVersion=mariadb-10.3.30'
DB_WAIT_TIMEOUT=60
DB_WAIT_INTERVAL=2

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo_info() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

echo_warn() {
    echo -e "${YELLOW}[WARN]${NC} $1"
}

echo_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Change to script directory
cd "$(dirname "$0")"

echo ""
echo "=========================================="
echo "  Retromat Docker Development Setup"
echo "=========================================="
echo ""
echo "This script will:"
echo "  1. Create/update backend/.env.local"
echo "  2. Start Docker containers"
echo "  3. Wait for database to be ready"
echo "  4. Set up the main database (import SQL dump)"
echo "  5. Install PHP dependencies (composer install)"
echo "  6. Run database migrations"
echo "  7. Clear doctrine caches"
echo "  8. Set up the test database (DROP and recreate)"
echo "  9. Generate templates from index.php"
echo ""
echo -e "${YELLOW}WARNING: This will:${NC}"
echo "  - Overwrite backend/.env.local if it differs"
echo "  - DROP and recreate the test database"
echo ""

# Confirmation prompt
read -p "Do you want to proceed? [y/N] " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "Aborted."
    exit 0
fi

echo ""

# Check prerequisites
echo_info "Checking prerequisites..."

if ! command -v docker &> /dev/null; then
    echo_error "Docker is not installed or not in PATH"
    exit 1
fi

if ! docker info &> /dev/null; then
    echo_error "Docker daemon is not running"
    exit 1
fi

if [ ! -f "docker-compose.yml" ]; then
    echo_error "docker-compose.yml not found in $(pwd)"
    exit 1
fi

if [ ! -f "docker-ports.env" ]; then
    echo_error "docker-ports.env not found in $(pwd)"
    exit 1
fi

echo_info "Prerequisites OK"

# Create/update .env.local
echo_info "Setting up $ENV_LOCAL_FILE..."

if [ -f "$ENV_LOCAL_FILE" ]; then
    EXISTING_CONTENT=$(cat "$ENV_LOCAL_FILE")
    if [ "$EXISTING_CONTENT" = "$ENV_LOCAL_CONTENT" ]; then
        echo_info "$ENV_LOCAL_FILE already exists with correct content, skipping"
    else
        echo_warn "$ENV_LOCAL_FILE exists with different content, overwriting"
        echo "$ENV_LOCAL_CONTENT" > "$ENV_LOCAL_FILE"
    fi
else
    echo "$ENV_LOCAL_CONTENT" > "$ENV_LOCAL_FILE"
    echo_info "Created $ENV_LOCAL_FILE"
fi

# Start containers
echo_info "Starting Docker containers..."
docker compose --env-file docker-ports.env up -d

# Wait for database to be ready
echo_info "Waiting for database to be ready (timeout: ${DB_WAIT_TIMEOUT}s)..."

SECONDS_WAITED=0
until docker compose exec -T db mariadb -u root -pPaSsWoRd -e "SELECT 1" &> /dev/null; do
    if [ $SECONDS_WAITED -ge $DB_WAIT_TIMEOUT ]; then
        echo_error "Database did not become ready within ${DB_WAIT_TIMEOUT} seconds"
        exit 1
    fi
    echo "  Waiting for database... (${SECONDS_WAITED}s)"
    sleep $DB_WAIT_INTERVAL
    SECONDS_WAITED=$((SECONDS_WAITED + DB_WAIT_INTERVAL))
done

echo_info "Database is ready"

# Run database setup
echo_info "Setting up main database..."
docker compose exec -T db sh -c "cd /app/backend && ./db-setup-in-docker.sh"

# Install dependencies
echo_info "Installing PHP dependencies..."
docker compose exec -T php-fpm sh -c "cd /app/backend && composer install"

# Run migrations
echo_info "Running database migrations..."
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console doctrine:migrations:migrate --no-interaction"

# Clear caches
echo_info "Clearing doctrine caches..."
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console doctrine:cache:clear-result"
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console doctrine:cache:clear-query"
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console doctrine:cache:clear-metadata"

# Set up test database
echo_info "Setting up test database..."
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console --env=test doctrine:database:create --if-not-exists"
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console --env=test doctrine:database:drop --force"
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console --env=test doctrine:database:create"
docker compose exec -T php-fpm sh -c "cd /app/backend && php bin/console --env=test doctrine:migrations:migrate --no-interaction"

# Generate templates
echo_info "Generating templates from index.php..."
docker compose exec -T php-fpm sh -c "sh index_deploy-from-php-to-twig.sh"

echo ""
echo "=========================================="
echo -e "${GREEN}  Setup complete!${NC}"
echo "=========================================="
echo ""
echo "Visit:"
echo "  http://localhost:10180/"
echo ""
echo "Run tests with:"
echo "  docker compose exec php-fpm sh -c \"cd /app/backend && rm -rf var/cache && php -d memory_limit=1000M vendor/bin/phpunit\""
echo ""
