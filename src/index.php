<?php

// Error reporting configuration (disable display in production)
$isProduction = getenv('APP_ENV') === 'production';
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

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',
    'auto_reload' => !$isProduction,
    'debug' => !$isProduction,
]);

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

switch ($path) {
    case '/':
    case '/home':
        echo $twig->render('landing.twig', [
            'title' => 'Home Page - Twig Starter Template',
        ]);
        break;

    case '/dashboard':
        echo $twig->render('dashboard.twig', [
            'title' => 'Dashboard - Twig Starter Template',
        ]);
        break;

    default:
        http_response_code(404);
        echo $twig->render('404.twig', [
            'title' => '404 Not Found - Twig Starter Template',
        ]);
        break;
}
