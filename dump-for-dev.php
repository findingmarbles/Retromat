#!/usr/bin/env php
<?php

declare(strict_types=1);

// Check if running as retro2 user
$currentUser = posix_getpwuid(posix_geteuid())['name'] ?? getenv('USER') ?? '';
if ($currentUser !== 'retro2') {
    fwrite(STDERR, "\n");
    fwrite(STDERR, "Error: This script is specific to the live host.\n");
    fwrite(STDERR, "\n");
    fwrite(STDERR, "For development purposes, please read README_dev_Docker.md or README_dev_Uberspace.md\n");
    fwrite(STDERR, "\n");
    exit(1);
}

$sqlDumpsDir = '/var/www/virtual/retro2/retromat.git/backend/sql-dumps/';
$tmpFile = $sqlDumpsDir . 'tmp_retro2_retromat.sql';
$outputFile = $sqlDumpsDir . 'retromat-anonymized.sql';

// Change to sql-dumps directory
if (!chdir($sqlDumpsDir)) {
    fwrite(STDERR, "Error: Cannot change to directory: $sqlDumpsDir\n");
    exit(1);
}

// Run mysqldump
$mysqldumpCmd = "/usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat > $tmpFile";
exec($mysqldumpCmd, $output, $returnVar);
if ($returnVar !== 0) {
    fwrite(STDERR, "Error: mysqldump failed\n");
    exit(1);
}

// Create retromat-anonymized.sql by removing all user data and pw reset tokens
if (!file_exists($tmpFile)) {
    fwrite(STDERR, "Error: Temporary SQL file not found: $tmpFile\n");
    exit(1);
}

$inputHandle = fopen($tmpFile, 'r');
if ($inputHandle === false) {
    fwrite(STDERR, "Error: Cannot open input file: $tmpFile\n");
    exit(1);
}

$outputHandle = fopen($outputFile, 'w');
if ($outputHandle === false) {
    fwrite(STDERR, "Error: Cannot create output file: $outputFile\n");
    fclose($inputHandle);
    exit(1);
}

// Safe default password hash (bcrypt for "password")
$defaultPasswordHash = '$2y$13$KxxSkgG1NkPHm.Kk3ctkY.1CqJACjK7O4KKJQOqHM469E3rD87Z/2';

/**
 * Parse SQL value - handles quoted strings with escaped quotes (doubled quotes in MySQL)
 */
function parseSqlValue(string $sql, int &$pos): ?string
{
    $len = strlen($sql);
    if ($pos >= $len) {
        return null;
    }

    // Skip whitespace
    while ($pos < $len && ctype_space($sql[$pos])) {
        $pos++;
    }

    if ($pos >= $len) {
        return null;
    }

    // Handle NULL
    if (substr($sql, $pos, 4) === 'NULL') {
        $pos += 4;
        return 'NULL';
    }

    // Handle quoted string
    if ($sql[$pos] === "'") {
        $pos++; // Skip opening quote
        $value = '';
        while ($pos < $len) {
            if ($sql[$pos] === "'") {
                // Check if it's an escaped quote (doubled)
                if ($pos + 1 < $len && $sql[$pos + 1] === "'") {
                    $value .= "'";
                    $pos += 2;
                } else {
                    // End of string
                    $pos++;
                    break;
                }
            } else {
                $value .= $sql[$pos];
                $pos++;
            }
        }
        return $value;
    }

    // Handle unquoted value (number, etc.)
    $start = $pos;
    while ($pos < $len && $sql[$pos] !== ',' && $sql[$pos] !== ')') {
        $pos++;
    }
    return substr($sql, $start, $pos - $start);
}

/**
 * Parse a single user record from SQL VALUES format
 * Format: (id,'username','email',enabled,salt,'password','roles')
 */
function parseUserRecord(string $record): ?array
{
    $pos = 0;
    $len = strlen($record);

    // Skip opening parenthesis
    if ($pos >= $len || $record[$pos] !== '(') {
        return null;
    }
    $pos++;

    $id = parseSqlValue($record, $pos);
    if ($id === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $username = parseSqlValue($record, $pos);
    if ($username === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $email = parseSqlValue($record, $pos);
    if ($email === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $enabled = parseSqlValue($record, $pos);
    if ($enabled === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $salt = parseSqlValue($record, $pos);
    if ($salt === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $password = parseSqlValue($record, $pos);
    if ($password === null || $pos >= $len || $record[$pos] !== ',') {
        return null;
    }
    $pos++; // Skip comma

    $roles = parseSqlValue($record, $pos);

    return [
        'id' => $id,
        'username' => $username,
        'email' => $email,
        'enabled' => $enabled,
        'salt' => $salt,
        'password' => $password,
        'roles' => $roles,
    ];
}

/**
 * Escape a string for SQL (doubles single quotes)
 */
function escapeSqlString(string $str): string
{
    return str_replace("'", "''", $str);
}

while (($line = fgets($inputHandle)) !== false) {
    // Normalize line endings: remove any existing line terminators (CR, LF, LS, PS, etc.)
    $line = rtrim($line, "\r\n\x{2028}\x{2029}");

    // Skip user_reset_password_request INSERT statements
    if (preg_match('/^INSERT INTO `user_reset_password_request`/', $line)) {
        continue;
    }

    // Process user table INSERT statements
    if (preg_match('/^INSERT INTO `user` VALUES (.+)$/', $line, $matches)) {
        $values = $matches[1];

        // Split records by ),( pattern
        $records = preg_split('/\)\s*,\s*\(/', $values);
        $anonymizedRecords = [];

        foreach ($records as $record) {
            // Add back parentheses if they were removed by split
            if (!str_starts_with($record, '(')) {
                $record = '(' . $record;
            }
            if (!str_ends_with($record, ')')) {
                $record = $record . ')';
            }

            $userData = parseUserRecord($record);
            if ($userData === null) {
                // If parsing fails, keep original
                $anonymizedRecords[] = $record;
                continue;
            }

            // Anonymize
            $id = $userData['id'];
            $anonymizedUsername = "user$id";
            $anonymizedEmail = "user$id@example.com";
            $anonymizedPassword = $defaultPasswordHash;
            $anonymizedSalt = 'NULL';
            $roles = $userData['roles'];

            // Rebuild the record
            $anonymizedRecord = sprintf(
                "(%s,'%s','%s',%s,%s,'%s','%s')",
                $id,
                escapeSqlString($anonymizedUsername),
                escapeSqlString($anonymizedEmail),
                $userData['enabled'],
                $anonymizedSalt,
                escapeSqlString($anonymizedPassword),
                escapeSqlString($roles)
            );

            $anonymizedRecords[] = $anonymizedRecord;
        }

        $line = "INSERT INTO `user` VALUES " . implode(',', $anonymizedRecords) . ';';
    }

    // Always write with standard Unix line ending
    fwrite($outputHandle, $line . "\n");
}

fclose($inputHandle);
fclose($outputHandle);

// Remove temporary file
if (file_exists($tmpFile)) {
    unlink($tmpFile);
}

echo "Successfully created anonymized SQL dump: $outputFile\n";
