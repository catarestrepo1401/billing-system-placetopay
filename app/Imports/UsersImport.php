<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::where('identification', $row[0])->first();

            if (!$user) {
                $newUser = new User();

                $newUser->fillable([
                    'identification' => $row[0],
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'full_name' => $row[3],
                    'email' => $row[4],
                    'password' => Hash::make($row[5]),
                    'created_at' => $row[6],
                    'updated_at' => $row[7],
                ]);

                $newUser->fill([
                    'identification' => $row[0],
                    'first_name' => $row[1],
                    'last_name' => $row[2],
                    'full_name' => $row[3],
                    'email' => $row[4],
                    'password' => Hash::make($row[5]),
                    'created_at' => Date::excelToDateTimeObject($row[6]),
                    'updated_at' => Date::excelToDateTimeObject($row[7]),
                ]);

                $newUser->save();
            }
        }
    }
}


