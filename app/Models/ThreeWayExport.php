<?php

namespace App\Models;

use App\Exports\LaravelUsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\CarbonInterval;
use Spatie\SimpleExcel\SimpleExcelWriter;



class ThreeWayExport
{


    public static function laravel($filename, $driver): array
    {
        $start = now();

        Excel::store(new LaravelUsersExport, $filename, $driver);

        return [
            'status' => 'ok',
            'type' => 'LaravelExport',
            'time' => self::duration($start),
            'start' => $start,
        ];
    }


    public static function spatie($filename): array
    {
        $start = now();

        $rows = self::getUsers(1000);

        SimpleExcelWriter::create($filename)
            ->noHeaderRow()
            ->addRows($rows);

        return [
            'status' => 'ok',
            'type' => 'SpatieExport',
            'time' => self::duration($start),
            'start' => $start,
        ];
    }


    public static function php($filename): array
    {
        $start = now();

        self::makePHPExport($filename);

        return [
            'status' => 'ok',
            'type' => 'PHPExport',
            'time' => self::duration($start),
            'start' => $start,
        ];
    }


    private static function duration($start): string
    {
        return CarbonInterval::seconds($start->diffInSeconds(now()))->cascade()->forHumans();
    }


    // это, конечно, жестко. Нужно через генератор написать.
    private static function makePHPExport($filename)
    {
        $handle = fopen(public_path($filename), 'w');
        $users = self::getUsers(1000);

        foreach ($users as $user) {
            fputcsv($handle, $user);
        }

        fclose($handle);

    }


    // место ей в модели, но пусть здесь будет
    private static function getUsers(int $num): array
    {
        $rows = [];
        User::chunk($num, function ($users) use (&$rows) {
            foreach ($users->toArray() as $user) {
                $rows[] = $user;
            }
        });


        return $rows;
    }


}


