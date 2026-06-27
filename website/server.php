<?php
/**
 * DARTE Dev Server with Gzip Compression
 * =========================================
 * Replaces `php artisan serve` with actual gzip support for static assets.
 *
 * STOP your current server, then run from the project root:
 *   php -S 127.0.0.1:8000 server.php
 *
 * This compresses CSS/JS files on-the-fly:
 *   style.min.css: 1,561 KB → ~200 KB (87% reduction)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$publicPath = __DIR__ . '/public';
$file       = $publicPath . $uri;

// --- Serve static files with optional gzip compression ---
if ($uri !== '/' && is_file($file)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    $compressible = ['css', 'js', 'svg', 'json', 'xml', 'html', 'txt'];
    $mimeTypes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'svg'  => 'image/svg+xml',
        'json' => 'application/json',
        'xml'  => 'application/xml',
        'html' => 'text/html',
        'txt'  => 'text/plain',
        'webp' => 'image/webp',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
        'otf'  => 'font/otf',
        'eot'  => 'application/vnd.ms-fontobject',
    ];

    $acceptsGzip = str_contains($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip');

    // Serve compressible text assets with gzip
    if (in_array($ext, $compressible) && $acceptsGzip) {
        $content    = file_get_contents($file);
        $compressed = gzencode($content, 6);
        $mime       = $mimeTypes[$ext] ?? 'text/plain';

        if (in_array($ext, ['css', 'js', 'html', 'txt', 'json', 'xml', 'svg'])) {
            $mime .= '; charset=UTF-8';
        }

        header('Content-Type: '     . $mime);
        header('Content-Encoding: gzip');
        header('Content-Length: '   . strlen($compressed));
        header('Cache-Control: public, max-age=31536000, immutable');
        header('Vary: Accept-Encoding');
        header('X-Compressed-By: DarteDevServer');

        echo $compressed;
        return true;
    }

    // Serve non-compressible static files (images, fonts, etc.) normally
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        header('Cache-Control: public, max-age=31536000, immutable');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        return true;
    }

    // Let PHP handle everything else as static
    return false;
}

// --- All non-static requests go through Laravel ---
$_SERVER['SCRIPT_NAME']     = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $publicPath . '/index.php';

require_once $publicPath . '/index.php';
