<?php

namespace App\Services;

class ErrorLogger {
    private const LOG_FILE = BASE_PATH . '/storage/logs/error.log';

    public static function log(string $message, string $level = 'ERROR', array $context = []): void {
        $logDir = dirname(self::LOG_FILE);
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $logMessage = "[{$timestamp}] [{$level}] {$message}{$contextStr}" . PHP_EOL;

        file_put_contents(self::LOG_FILE, $logMessage, FILE_APPEND);
    }

    public static function info(string $message, array $context = []): void {
        self::log($message, 'INFO', $context);
    }

    public static function warning(string $message, array $context = []): void {
        self::log($message, 'WARNING', $context);
    }

    public static function error(string $message, array $context = []): void {
        self::log($message, 'ERROR', $context);
    }

    public static function debug(string $message, array $context = []): void {
        // Check debug mode using $_SERVER or DEFAULT to false
        $debugMode = defined('APP_DEBUG') ? APP_DEBUG : false;
        if ($debugMode) {
            self::log($message, 'DEBUG', $context);
        }
    }
}
