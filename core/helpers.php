<?php

namespace core;

function normalizeUri(string $requestUri, string $basePath): string
{
    $path = parse_url($requestUri, PHP_URL_PATH);
    $normalizedUri = str_replace($basePath, '', $path);
    $normalizedUri = '/' . ltrim($normalizedUri, '/');
    
    if ($normalizedUri === '//') {
        $normalizedUri = '/';
    }
    return $normalizedUri;
}