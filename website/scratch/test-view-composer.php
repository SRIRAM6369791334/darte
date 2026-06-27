<?php
// C:\xampp\htdocs\darte\New folder\web (1)\test-view-composer.php

use Illuminate\Support\Facades\View;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

View::composer('*', function ($view) {
    echo "Composing: " . $view->getName() . " | Has meta: " . (isset($view->getData()['meta']) ? 'YES' : 'NO') . "\n";
});

// Simulate a controller action
$view = view('pages.shop-details', ['meta' => (object)['title' => 'Product Title']]);
echo "Rendering...\n";
$view->render();
