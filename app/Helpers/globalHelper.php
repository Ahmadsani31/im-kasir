<?php

if (!function_exists('formatDate')) {
    function formatDate($dateString)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateString)->format('j-F, Y');
    }
}

if (!function_exists('asset_url')) {
    function assetUrl($path)
    {
        return asset('/') . $path;
    }
}
