<?php

// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',
    'auto_reload' => true,
]);

// Parse and sanitize the request path
$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = filter_var($rawPath, FILTER_SANITIZE_URL);
$path = preg_replace('/[^a-zA-Z0-9\-\/]/', '', $path);

switch ($path) {
    case '/':
    case '/home':
        echo $twig->render('landing.twig', [
            'title' => 'Landing Page - Twig Starter Template',
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
