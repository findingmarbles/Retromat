# PHPStan Quality Analysis Guide

This document explains how to use PHPStan effectively in this Symfony project.

## Overview

PHPStan is configured with **level 6** (maximum strictness) and uses a **baseline** to ignore 363 existing legacy issues. This means you'll only see new issues or critical problems that need immediate attention.

## How to Run PHPStan Effectively

### 1. Daily Development Check
Quick check to see only new/important issues:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse --memory-limit=2g"
```

### 2. Detailed Analysis
More verbose output with error identifiers:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse --memory-limit=2g -v"
```

### 3. Focus on Specific Files
Analyze only files you're working on:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse src/Service/YourService.php --memory-limit=2g"
```

### 4. Analyze Specific Directory
Focus on a particular directory:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse src/Controller/ --memory-limit=2g"
```

### 5. Update Baseline (when cleaning up legacy code)
Regenerate baseline after fixing issues:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse --memory-limit=2g --generate-baseline=phpstan-baseline.neon"
```

### 6. Clear Cache (if needed)
If you encounter strange errors:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan clear-cache"
```

## Configuration

### Current Setup (`phpstan.dist.neon`)
- **Level**: 6 (maximum strictness)
- **Baseline**: `phpstan-baseline.neon` (ignores 363 legacy issues)
- **Scanned paths**: `src/` and `tests/`
- **Excluded**: `tests/bootstrap.php`, `src/Kernel.php`

### Files
- `phpstan.dist.neon` - Main configuration
- `phpstan-baseline.neon` - Baseline with ignored legacy issues (auto-generated)

## Understanding Results

### Expected Output
When everything is clean:
```
 [OK] No errors
```

### When Issues Are Found
PHPStan will show:
- **File and line number** where the issue occurs
- **Error description** explaining the problem
- **Error identifier** (e.g., `🪪 variable.undefined`)

### Common Error Types
- `variable.undefined` - Variable might not be defined
- `argument.type` - Wrong type passed to function
- `method.notFound` - Calling non-existent method
- `missingType.return` - Missing return type declaration

## Best Practices

### 1. Fix New Issues Immediately
When PHPStan finds errors in your new code, fix them right away. Don't add them to the baseline.

### 2. Gradual Legacy Cleanup
- Pick one legacy file/class at a time
- Fix all PHPStan issues in that file
- Remove those entries from the baseline
- Commit the changes

### 3. Pre-commit Checks
Consider adding PHPStan to your git pre-commit hooks:
```bash
#!/bin/sh
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && vendor/bin/phpstan analyse --memory-limit=2g --no-progress"
```

## Troubleshooting

### Memory Issues
If you get memory errors, increase the limit:
```bash
--memory-limit=4g
```

### Performance Issues
For faster analysis during development:
```bash
--no-progress  # Removes progress bar
--quiet        # Less output
```

## Learning Resources

- [PHPStan Documentation](https://phpstan.org/user-guide/getting-started)
- [Rule Levels](https://phpstan.org/user-guide/rule-levels)
- [Symfony Extension](https://github.com/phpstan/phpstan-symfony)

---

*This configuration ensures high code quality for new development while managing legacy technical debt effectively.* 