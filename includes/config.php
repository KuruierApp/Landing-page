<?php
/**
 * Runtime configuration loader.
 *
 * Secrets never live in source. Resolution order per key, first hit wins:
 *   1. A real environment variable (Plesk FastCGI env, CI, shell export)
 *   2. An env file one level ABOVE the web root  (../private/kuruier.env)
 *   3. .env sitting in the web root              (last resort, dev convenience)
 *
 * A key that resolves nowhere is a hard failure, never a silent empty string.
 * Values are cached in memory only -- deliberately NOT pushed into putenv()/$_ENV,
 * so they cannot leak into child-process environments or a phpinfo() dump.
 *
 * Kept PHP 5.5-compatible: the Plesk PHP version is not pinned anywhere in the repo.
 */

/**
 * Parse an env file into a key => value array.
 * Blank lines and # comments are skipped; the line is split on the FIRST '='
 * only, so values may themselves contain '='. One layer of surrounding
 * single or double quotes is stripped.
 */
function kuruier_parse_env_file($path)
{
    $values = array();
    $lines = @file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return $values;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') {
            continue;
        }

        $split = strpos($line, '=');
        if ($split === false) {
            continue;
        }

        $key = trim(substr($line, 0, $split));
        $value = trim(substr($line, $split + 1));
        if ($key === '') {
            continue;
        }

        $len = strlen($value);
        if ($len >= 2) {
            $first = $value[0];
            $last = $value[$len - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, $len - 2);
            }
        }

        $values[$key] = $value;
    }

    return $values;
}

/**
 * Load (once) and return the merged contents of the first env file found.
 * Paths are relative to this file, so no absolute server path is baked in.
 */
function kuruier_env_file_values()
{
    static $values = null;
    if ($values !== null) {
        return $values;
    }

    $candidates = array(
        __DIR__ . '/../../private/kuruier.env', // outside the web root -- preferred in prod
        __DIR__ . '/../.env',                   // web root -- dev convenience
    );

    $values = array();
    foreach ($candidates as $path) {
        if (is_readable($path)) {
            $values = kuruier_parse_env_file($path);
            break;
        }
    }

    return $values;
}

/**
 * Resolve a single configuration key, or return $default when unset.
 */
function kuruier_config($key, $default = null)
{
    $fromEnv = getenv($key);
    if ($fromEnv !== false && trim($fromEnv) !== '') {
        return trim($fromEnv);
    }

    $values = kuruier_env_file_values();
    if (isset($values[$key]) && $values[$key] !== '') {
        return $values[$key];
    }

    return $default;
}

/**
 * Resolve a key that the application cannot run without.
 * Throws naming ONLY the key -- never the value.
 */
function kuruier_config_required($key)
{
    $value = kuruier_config($key, null);
    if ($value === null || $value === '') {
        throw new RuntimeException('Missing required configuration key: ' . $key);
    }

    return $value;
}
