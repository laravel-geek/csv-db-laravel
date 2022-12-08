<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class LaravelUsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([

            'user_name'     => $row[1],
            'first_name'    => $row[2],
            'last_name'     => $row[3],
            'patronymic'    => $row[4],
            'email'         => $row[5],
            'password'      => Hash::make($row[6]),

        ]);
    }
}
