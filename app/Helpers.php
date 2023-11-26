<?php

namespace App;

class Helpers
{
    /**
     * Convert the date in european format
     * 
     * @param string  $date
     *
     * @return string
     */
    public static function convertDate(string $date): string
    {
        return \DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    /**
     * Check that the text is less than the max length and return it, 
     * else truncate the text and return it
     * 
     * @param string  $date
     * @param int     $maxLength
     *
     * @return string
     */
    public static function truncateText(string $text, int $maxLength = 85): string
    {
        if (strlen($text) <= $maxLength) {
            return $text;
        } else {
            return substr($text, 0, $maxLength - 3) . '...';
        }
    }

}