<?php

namespace App\Services;

use DateTime;
use DateInterval;

class Helper
{
    /*
     * Получаем два значения -- тип периода и его значение (положительное или отрицательное) в виде массива
     */
    public static function calculatePeriodFromNow(DateTime $dateTime): array
    {
        $diff = (new DateTime())->diff($dateTime); 

        $period = match (true) {

            intval($diff->format('%Y')) != 0 => [
                'type' => 'год',
                'value' => intval($diff->format('%R%Y'))
            ],
            intval($diff->format('%m')) != 0 => [
                'type' => 'месяц',
                'value' => intval($diff->format('%R%m'))
            ],
            intval($diff->format('%d')) != 0 => [
                'type' => 'день',
                'value' => intval($diff->format('%R%d'))
            ],


            default => [
                'type' => 'null',
                'value' => 0
            ]
        };

        return $period;
    }

    /*
     * Получаем тектовую фразу о периоде события
     */
    public static function getPeriodPhrase(?string $type, ?int $val) : ?string {

        if(is_null($type) || is_null($val)) {
            return null;
        }

        if($val >= 0) {
            return 'Через ' . strval($val) . ' ' . $type;
        }
        else {
            return 'Было ' . strval(abs($val)) . ' ' . $type . ' назад';            
        }
    }
}
