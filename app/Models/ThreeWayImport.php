<?php

namespace App\Models;

use App\Imports\LaravelUsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\CarbonInterval;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




class ThreeWayImport
{


    public static function laravel($filename, $driver): array
    {
        $start = now();

        Excel::import(new LaravelUsersImport, $filename, $driver);

        return [
            'status' => 'ok',
            'type' => 'LaravelImport',
            'time' => self::duration($start),
            'start' => $start,
        ];

    }



    public static function spatie($filename): array
    {
        $start = now();

        SimpleExcelReader::create('SpatieUsersExport.csv')
            ->noHeaderRow()
            ->getRows()
            ->each(function (array $rowProperties) {
                User::create(
                    ([
                        'user_name' => $rowProperties[1],
                        'first_name' => $rowProperties[2],
                        'last_name' => $rowProperties[3],
                        'patronymic' => $rowProperties[4],
                        'email' => $rowProperties[5],
                        'password' => Hash::make($rowProperties[6]),
                    ])
                );
            });

        return [
            'status' => 'ok',
            'type' => 'SpatieImport',
            'time' => self::duration($start),
            'start' => $start,
        ];
    }


    public static function php($filename): array
    {
        $start = now();

        $users = array_map('str_getcsv', file('PHPUsersExport.csv'));
        $names = [];

        foreach ($users as $user) {
            $name = (string)Str::of($user[1])->before(' ');

            User::create(
                ([
                    'user_name' => $user[1],
                    'first_name' => $user[2],
                    'last_name' => $user[3],
                    'patronymic' => $user[4],
                    'email' => $user[5],
                    'password' => Hash::make($user[6]),
                ])
            );

            if (!array_key_exists($name, $names)) {
                $names[$name] = 0;
            }

            $names[$name]++;
        }

        return [
            'status' => 'ok',
            'type' => 'PHPImport',
            'time' => self::duration($start),
            'start' => $start,
        ];
    }


    private static function duration($start): string
    {
        return CarbonInterval::seconds($start->diffInSeconds(now()))->cascade()->forHumans();
    }


}


