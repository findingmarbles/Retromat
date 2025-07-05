# PHP CS Fixer Configuration

This project uses PHP CS Fixer with the official `@Symfony` ruleset.

## Configuration

The configuration file is located at `backend/.php-cs-fixer.dist.php` and includes:

- **@Symfony ruleset** <https://cs.symfony.com/doc/ruleSets/Symfony.html>
- **@PSR12 rulset** <https://cs.symfony.com/doc/ruleSets/PSR12.html>

## Usage

### Using Docker (Recommended)

```bash
# Run PHP CS Fixer to fix all files
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php"

# Dry run to see what would be fixed
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php vendor/bin/php-cs-fixer fix --dry-run --diff --config=.php-cs-fixer.dist.php"

# Fix only specific directory
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php src/"
```

### Using Local PHP

```bash
# Navigate to backend directory
cd backend

# Run PHP CS Fixer to fix all files
./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php

# Dry run to see what would be fixed
./vendor/bin/php-cs-fixer fix --dry-run --diff --config=.php-cs-fixer.dist.php

# Fix only specific directory
./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php src/
```

## IDE Integration

### PhpStorm
1. Go to `File` → `Settings` → `Tools` → `PHP CS Fixer`
2. Enable `Enable PHP CS Fixer`
3. Set `PHP CS Fixer path` to `vendor/bin/php-cs-fixer`
4. Set `Rules` to `Custom` and point to `.php-cs-fixer.dist.php`

### VS Code
Install the `PHP CS Fixer` extension and add to your `settings.json`:
```json
{
    "php-cs-fixer.executablePath": "vendor/bin/php-cs-fixer",
    "php-cs-fixer.config": ".php-cs-fixer.dist.php"
}
```
