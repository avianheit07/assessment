<?php

if (!function_exists('getContrastingColor')) {
    function getContrastingColor($hexColor) {
        // Remove the hash if it exists
        $hexColor = ltrim($hexColor, '#');

        // Convert hex to RGB
        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        // Calculate luminance
        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

        // Return black or white based on luminance
        return $luminance > 0.5 ? '#000000' : '#FFFFFF';
    }
}