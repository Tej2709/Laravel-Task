<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Photo',
            'Gender',
            'Age',
            'Created_at',
            'Updated_at' 
        ];
    }
    public function collection()
    {
        return User::all();
    }
}
