<?php

namespace App\Http\Controllers;

use App\Models\ThreeWayExport;
use App\Models\ThreeWayImport;


// Выдалось немного времени - написал часть функционала (экспорт/импорт).
// Конечно, надо все это завести на очереди, "нативный php" написать через генератор,
// добавить валидацию, немного причесать (объявить свойства и т. п.), написать по-модному - через Actions и т. п.
// Но идея-то понятна.


class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function export()
    {

        // Laravel Excel
        $result_laravel = ThreeWayExport::laravel(
            'LaravelUsersExport.csv',
            'real_public'
        );

        // Spatie
        $result_spatie = ThreeWayExport::spatie('SpatieUsersExport.csv');

        // PHP
        $result_php = ThreeWayExport::php('PHPUsersExport.csv');

        return view('result')
            ->with('laravel', $result_laravel)
            ->with('spatie', $result_spatie)
            ->with('php', $result_php);
    }


    public function import()
    {

        // Laravel Excel
        $result_laravel = ThreeWayImport::laravel(
            'LaravelUsersExport.csv',
            'real_public'
        );

        // Spatie
        $result_spatie = ThreeWayImport::spatie('SpatieUsersExport.csv');

        // PHP
        $result_php = ThreeWayImport::php('PHPUsersExport.csv');

        return view('result')
            ->with('laravel', $result_laravel)
            ->with('spatie', $result_spatie)
            ->with('php', $result_php);
    }


}
