#!/bin/sh

# This script must be run inside the db container:
# docker exec -it retromat-db-1 sh -c "cd /app/backend && ./db-setup-in-docker.sh [DB_NAME]"

# Verify we're in the db container
if ! command -v mariadb >/dev/null 2>&1; then
    echo "Error: This script must be run inside the db container."
    echo "Usage: docker exec -it retromat-db-1 sh -c 'cd /app/backend && ./db-setup-in-docker.sh [DB_NAME]'"
    exit 1
fi

# Configuration
DB_ROOT_PASSWORD="${MYSQL_ROOT_PASSWORD:-PaSsWoRd}"
DB_COLLATION="utf8mb4_unicode_ci"
SQL_DUMP_PATH="/app/backend/sql-dumps/retromat-anonymized.sql"
ENV_FILE_PATH="/app/backend"

# Get database name from argument or .env files
if [ -n "$1" ]; then
    DB_NAME="$1"
else
    if [ -f "$ENV_FILE_PATH/.env.local" ]; then
        DATABASE_URL=$(grep "^DATABASE_URL=" "$ENV_FILE_PATH/.env.local" | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    elif [ -f "$ENV_FILE_PATH/.env" ]; then
        DATABASE_URL=$(grep "^DATABASE_URL=" "$ENV_FILE_PATH/.env" | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    fi
    
    if [ -n "$DATABASE_URL" ]; then
        DB_NAME=$(echo "$DATABASE_URL" | sed -E 's|.*/([^/?]+).*|\1|')
    fi
    
    if [ -z "$DB_NAME" ]; then
        echo "Error: Could not determine database name."
        echo "Usage: ./db-setup-in-docker.sh DB_NAME"
        exit 1
    fi
fi

echo "Setting up database: $DB_NAME"

# Check if SQL dump exists
if [ ! -f "$SQL_DUMP_PATH" ]; then
    echo "Error: SQL dump not found at $SQL_DUMP_PATH"
    exit 1
fi

# Create database
echo "Creating database '$DB_NAME'..."
export MYSQL_PWD="$DB_ROOT_PASSWORD"
mariadb -u root -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE $DB_COLLATION;"

if [ $? -ne 0 ]; then
    echo "Error: Failed to create database."
    exit 1
fi

# Import SQL dump
echo "Importing SQL dump..."
mariadb -u root "$DB_NAME" < "$SQL_DUMP_PATH"

if [ $? -ne 0 ]; then
    echo "Error: Failed to import SQL dump."
    exit 1
fi

echo "Database '$DB_NAME' is ready."
