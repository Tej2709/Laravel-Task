<?php

namespace App\Exports;

use App\Models\Resort;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResortExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'id',
            'name',
            'description',
            'image',
            'bigimage',
            'status',
            'Created_at',
            'Updated_at' 
        ];
    }
    public function collection()
    {
        return Resort::all();
    }
}
