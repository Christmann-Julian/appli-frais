<?php

/**
 * Helpers
 * 
 * Helpers gives methods to help developer
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

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
     * Convert the month number in french month 
     * 
     * @param int  $monthNumber
     *
     * @return string
     */
    public static function convertMonth(int $monthNumber): string
    {
        switch ($monthNumber) {
            case 1:
                $month = "Janvier";
                break;
            case 2:
                $month = "Février";
                break;
            case 3:
                $month = "Mars";
                break;
            case 4:
                $month = "Avril";
                break;
            case 5:
                $month = "Mai";
                break;
            case 6:
                $month = "Juin";
                break;
            case 7:
                $month = "Juillet";
                break;
            case 8:
                $month = "Août";
                break;
            case 9:
                $month = "Septembre";
                break;
            case 10:
                $month = "Octobre";
                break;
            case 11:
                $month = "Novembre";
                break;
            case 12:
                $month = "Décembre";
                break;
            default:
                $month = "erreur";
                break;
        }
        return $month;
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