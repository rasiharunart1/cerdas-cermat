<?php
header('Content-Type: text/html; charset=utf-8');
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Cerdas Cermat — Laravel skeleton staged</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;margin:2rem;line-height:1.5}code{background:#f5f5f5;padding:2px 4px;border-radius:4px}</style>
</head>
<body>
  <h1>Laravel skeleton is staged</h1>
  <p>This repository is migrating to Laravel 11. To run locally:</p>
  <ol>
    <li>Install PHP 8.2+, Composer, and Node.js.</li>
    <li>Run <code>composer install</code>.</li>
    <li>Copy env & generate key: <code>cp .env.example .env && php artisan key:generate</code>.</li>
    <li>Start dev server: <code>php artisan serve</code>.</li>
  </ol>
  <p><strong>Note:</strong> CI intentionally skips installs to avoid firewall blocks.</p>
  <p>Legacy app remains available in <code>legacy-quiz/</code>.</p>
</body>
</html>