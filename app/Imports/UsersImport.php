<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'identification' => $row[0],
            'first_name' => $row[1],
            'last_name' => $row[2],
            'full_name' => $row[3],
            'email' => $row[4],
            'password' => Hash::make($row[5]),
            'created_at' => $row[6],
            'updated_at' => $row[7],
        ]);
    }
}
