<?php

namespace App\Utils;

class Utils
{

    public static function parseReadingTime($time)
    {
        if (!is_numeric($time)) {
            $time = 1;
        }

        return ($time == 1 ? '1 minuta čtení' : (($time >= 2 && $time <= 4) ? $time . ' minuty čtení' : $time . ' minut čtení'));
    }

    public static function getRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function parseMonth($month){
        $months = [
            '1' => 'Leden',
            '2' => 'Únor',
            '3' => 'Březen',
            '4' => 'Duben',
            '5' => 'Květen',
            '6' => 'Červen',
            '7' => 'Červenec',
            '8' => 'Srpen',
            '9' => 'Září',
            '10' => 'Říjen',
            '11' => 'Listopad',
            '12' => 'Prosinec',
        ];
        return $months[$month];
    }

}