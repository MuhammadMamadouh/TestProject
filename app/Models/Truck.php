<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Truck extends Model
{
    use HasFactory;

    public $table = 'trucks';

    protected $fillable = ['license', 'width', 'depth', 'height', 'truck_type'];

    public function truckType()
    {
        return $this->belongsTo(TruckType::class, 'truck_type');
    }
    public function getWritables()
    {
        $truck_types = DB::table('trucks_types')->select('id', 'type_name')->get();
        return [

            'license' => ['type' => 'text', 'required' => true, 'text' => 'License'],
            'width' => ['type' => 'number', 'required' => true, 'text' => 'width'],
            'depth' => ['type' => 'number', 'required' => true, 'text' => 'depth'],
            'height' => ['type' => 'number', 'required' => true, 'text' => 'height'],
            'truck_type' => [
                'type' => 'selection',
                'values' => collect($truck_types)->map(function ($item) {
                    return ['value' => $item->id, 'text' => $item->type_name];
                }),
                'text' => 'Truck Type',
                'required' => true,
            ],
        ];
    }

    public function getReadables()
    {
        return [
            ['text' => 'License', 'value' => 'license'],
            ['text' => 'Width', 'value' => 'width'],
            ['text' => 'Depth', 'value' => 'depth'],
            ['text' => 'Height', 'value' => 'height'],
            ['text' => 'Truck type', 'value' => 'type'],
            ['text' => 'Actions', 'value' => 'Actions'],

        ];
    }
}
