<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $table = 'items';

    protected $fillable = ['name', 'qty',	'width',	'height',	'depth',	'order_id'	];

    
}
