<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function getTrucks($id)
    {
        $trucks = Truck::where('truck_type', $id)->get()->map(function($item){
            return ['id' => $item->id, 'license' => $item->license];
        });
        return response()->json($trucks);
    }
}
