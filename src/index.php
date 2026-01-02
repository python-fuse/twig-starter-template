<?php

/**
 * Application Entry Point
 * 
 * Bootstraps the application, loads environment variables,
 * configures error handling, and routes requests.
 */

// Autoloader (must be first to load Dotenv)
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad(); // Won't throw if .env is missing

// Environment configuration
$isProduction = ($_ENV['APP_ENV'] ?? 'development') === 'production';
$isDebug = filter_var($_ENV['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOLEAN);
$appName = $_ENV['APP_NAME'] ?? 'Twig Starter Template';

// Error reporting configuration
if ($isProduction) {
    error_reporting(0);
    ini_set('display_errors', '0');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
ini_set('log_errors', '1');

// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");

// Initialize Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',
    'auto_reload' => !$isProduction,
    'debug' => $isDebug,
]);

// Add global variables available in all templates
$twig->addGlobal('app_name', $appName);
$twig->addGlobal('is_production', $isProduction);

// Global exception handler
set_exception_handler(function (Throwable $e) use ($twig, $isProduction) {
    http_response_code(500);
    
    if ($isProduction) {
        echo $twig->render('error.twig', [
            'title' => '500 Internal Server Error',
            'message' => 'An unexpected error occurred. Please try again later.',
        ]);
    } else {
        echo $twig->render('error.twig', [
            'title' => '500 Internal Server Error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
    
    error_log($e->getMessage() . "\n" . $e->getTraceAsString());
});

// Parse and sanitize the request path
$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = filter_var($rawPath, FILTER_SANITIZE_URL);
$path = preg_replace('/[^a-zA-Z0-9\-\/]/', '', $path);

// Simple router
switch ($path) {
    case '/':
    case '/home':
        echo $twig->render('landing.twig', [
            'title' => 'Landing Page',
        ]);
        break;

    case '/dashboard':
        echo $twig->render('dashboard.twig', [
            'title' => 'Dashboard',
        ]);
        break;

    default:
        http_response_code(404);
        echo $twig->render('404.twig', [
            'title' => '404 Not Found',
        ]);
        break;
}
