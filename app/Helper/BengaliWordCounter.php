<?php

namespace App\Helper;

class BengaliWordCounter
{
    public static function countWords($text)
    {
        // Remove HTML tags
        $text = strip_tags($text);

        // Replace all non-Bengali characters with a space
        $text = preg_replace('/[^\x{0980}-\x{09FF}]+/u', ' ', $text);

        // Trim and split the text into words
        $words = preg_split('/\s+/u', trim($text));

        // Count the number of words
        return count($words);
    }
}
