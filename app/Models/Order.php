<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';

    protected $fillable = ['sender_name', 'reciever_name', 'truck_id'];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function getWritables()
    {
        $truck_types = DB::table('trucks_types')->select('id', 'type_name')->get();
        return [

            'sender_name' => ['type' => 'text', 'required' => true, 'text' => 'Sender Name'],
            'reciever_name' => ['type' => 'text', 'required' => true, 'text' => 'Reciever Name'],
            'truck_type' => [
                'type' => 'selection',
                'values' => collect($truck_types)->map(function ($item) {
                    return ['value' => $item->id, 'text' => $item->type_name];
                }),
                'text' => 'Truck Type',
                'required' => true,
            ],
            'truck_id' => [
                'type' => 'selection',
                'values' => [],
                'text' => 'Truck',
                'required' => true,
            ],

        ];
    }

    public function getReadables()
    {
        return [
            ['text' => 'sender Name', 'value' => 'sender_name'],
            ['text' => 'Reciever Name', 'value' => 'reciever_name'],
            ['text' => 'Truck', 'value' => 'truck'],
            ['text' => 'Truck type', 'value' => 'type'],
            ['text' => 'Actions', 'value' => 'Actions'],

        ];
    }
}
