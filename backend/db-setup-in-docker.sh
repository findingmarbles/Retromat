#!/bin/sh

# Detect if running inside Docker or on host
INSIDE_DOCKER=false
if [ -d "/app/" ]; then
    INSIDE_DOCKER=true
    DB_HOST="${DB_HOST:-db}"
    SQL_DUMP_PATH="/app/backend/sql-dumps/retromat-anonymized.sql"
    ENV_FILE_PATH="/app/backend"
else
    # Running from host
    DB_HOST="${DB_HOST:-localhost}"
    SQL_DUMP_PATH="$(dirname "$0")/sql-dumps/retromat-anonymized.sql"
    ENV_FILE_PATH="$(dirname "$0")"
    
    # Check if docker is available
    if ! command -v docker >/dev/null 2>&1; then
        echo "Error: docker command not found."
        echo "This script must be run from the host machine where Docker is available."
        echo "Usage: ./db-setup-in-docker.sh [DB_NAME]"
        exit 1
    fi
    
    # Check if db container is running
    if ! docker ps --format '{{.Names}}' | grep -q '^retromat-db-1$'; then
        echo "Error: retromat-db-1 container is not running."
        echo "Please start Docker containers first: docker compose --env-file docker-ports.env up -d"
        exit 1
    fi
fi

# Default values
DB_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-PaSsWoRd}"
DB_COLLATION="utf8mb4_unicode_ci"

# Get database name from argument or environment
if [ -n "$1" ]; then
    DB_NAME="$1"
else
    # Try to extract from .env.local first, then .env
    if [ -f "$ENV_FILE_PATH/.env.local" ]; then
        DATABASE_URL=$(grep "^DATABASE_URL=" "$ENV_FILE_PATH/.env.local" | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    elif [ -f "$ENV_FILE_PATH/.env" ]; then
        DATABASE_URL=$(grep "^DATABASE_URL=" "$ENV_FILE_PATH/.env" | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    fi
    
    if [ -n "$DATABASE_URL" ]; then
        # Parse DATABASE_URL: mysql://user:password@host:port/dbname or mysql://user:password@host:port/dbname?param=value
        # Extract the database name (everything after the last / and before ? or end of string)
        DB_NAME=$(echo "$DATABASE_URL" | sed -E 's|.*/([^/?]+).*|\1|')
    fi
    
    if [ -z "$DB_NAME" ]; then
        echo "Error: Could not determine database name."
        echo "Please provide it as an argument: ./db-setup-in-docker.sh DB_NAME"
        echo "Or ensure DATABASE_URL is set in .env or .env.local"
        exit 1
    fi
fi

echo "Setting up database: $DB_NAME"
echo "Host: $DB_HOST"
echo ""

# Check if SQL dump exists
if [ ! -f "$SQL_DUMP_PATH" ]; then
    echo "Error: SQL dump not found at $SQL_DUMP_PATH"
    echo "Please ensure the file exists before running this script."
    exit 1
fi

# Function to run mysql/mariadb command
run_mysql() {
    if [ "$INSIDE_DOCKER" = true ]; then
        # Check if mysql client is available
        if command -v mysql >/dev/null 2>&1; then
            export MYSQL_PWD="$DB_ROOT_PASSWORD"
            mysql -h "$DB_HOST" -u root "$@"
        else
            echo "Error: mysql client is not available in this container."
            echo "Please run this script from the host instead."
            exit 1
        fi
    else
        # Run from host using db container (mariadb command is available)
        docker exec -i retromat-db-1 mariadb -u root -p"$DB_ROOT_PASSWORD" "$@"
    fi
}

# Create database
echo "Creating database '$DB_NAME' with collation '$DB_COLLATION'..."
run_mysql -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE $DB_COLLATION;" 2>&1

if [ $? -ne 0 ]; then
    echo "Error: Failed to create database. Please check:"
    echo "  - Database host is accessible: $DB_HOST"
    echo "  - Root password is correct (check docker-compose.yml for MYSQL_ROOT_PASSWORD)"
    exit 1
fi

echo "Database created successfully."
echo ""

# Import SQL dump
echo "Importing SQL dump from $SQL_DUMP_PATH..."
if [ "$INSIDE_DOCKER" = true ]; then
    if command -v mysql >/dev/null 2>&1; then
        export MYSQL_PWD="$DB_ROOT_PASSWORD"
        mysql -h "$DB_HOST" -u root "$DB_NAME" < "$SQL_DUMP_PATH" 2>&1
    else
        echo "Error: mysql client is not available in this container."
        echo "Please run this script from the host instead."
        exit 1
    fi
else
    # Run from host using db container (mariadb command is available)
    docker exec -i retromat-db-1 mariadb -u root -p"$DB_ROOT_PASSWORD" "$DB_NAME" < "$SQL_DUMP_PATH" 2>&1
fi

if [ $? -ne 0 ]; then
    echo "Error: Failed to import SQL dump."
    exit 1
fi

echo ""
echo "Database setup completed successfully!"
echo "Database '$DB_NAME' is ready to use."
