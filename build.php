<?php

require_once __DIR__ . '/vendor/autoload.php';

$baseUrl = getenv('BASE_URL') ?: '/twig-starter-template';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/src/templates');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('app_name', 'Twig Starter Template');
$twig->addGlobal('base_url', $baseUrl);

$outputDir = __DIR__ . '/docs';

if (is_dir($outputDir)) {
    shell_exec("rm -rf $outputDir");
}
mkdir($outputDir, 0755, true);
mkdir($outputDir . '/docs', 0755, true);
mkdir($outputDir . '/styles', 0755, true);
mkdir($outputDir . '/js', 0755, true);

$pages = [
    'index.html' => ['landing.twig', ['title' => 'Twig Starter Template']],
    'docs/index.html' => ['docs.twig', ['title' => 'Documentation']],
];

foreach ($pages as $output => $config) {
    $html = $twig->render($config[0], $config[1]);
    file_put_contents($outputDir . '/' . $output, $html);
    echo "- Built: $output\n";
}

copy(__DIR__ . '/src/styles/out.tailwind.css', $outputDir . '/styles/out.tailwind.css');
echo "- Copied: styles/out.tailwind.css\n";

copy(__DIR__ . '/src/js/preline.js', $outputDir . '/js/preline.js');
echo "- Copied: js/preline.js\n";

echo "\n- Static site built in /docs (base_url: $baseUrl)\n";
