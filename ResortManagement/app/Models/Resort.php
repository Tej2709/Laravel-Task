<?php
namespace App;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Resort extends Model
{
    use HasFactory , Sortable;

    protected $fillable =[

        'name','description','image','bigimage','status',
    ];

    public $sortable = ['id', 'name', 'description', 'image', 'bigimage', 'status'];
}
