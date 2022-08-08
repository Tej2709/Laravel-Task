<?php
namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Game extends Model
{
    use HasFactory , Sortable;

    protected $fillable =[

        'name',
        'description',
        'points',
        'resorts',
        'status',

    ];
    public $sortable = ['id', 'name', 'description', 'resorts','status'];

}
