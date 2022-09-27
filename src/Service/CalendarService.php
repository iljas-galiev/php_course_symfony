<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CalendarService
{
    public static function buildFromMonth(int $month): ?array
    {
        $data = [];

        if ($month < 1 || $month > 12) return null;

        $date = new \Datetime();
        $date->setDate(date('Y'), $month, 1)->setTime(0, 0, 0, 0);

        do {
            $data[] = [
                'day' => $date->format('d'),
                'weekday' => $date->format('N'),
                'date' => $date->format('d.m.Y'),
                'weekdayName' => self::getWeekday($date->format('N')),
                'isWeekend' => self::isWeekend($date->format('N')),
            ];
            $date->add(new \DateInterval('P1D'));
        } while ($date->format('m') == $month);

        return ['items' => $data, 'first' => $data[0]['weekday'], 'last' => end($data)['weekday']];
    }

    public static function getWeekday(int $day): ?string
    {
        return match ($day) {
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота',
            7 => 'Воскресенье',
            default => null
        };
    }

    public static function isWeekend(int $day): bool
    {
        return $day >= 6 && $day <= 7;
    }
}