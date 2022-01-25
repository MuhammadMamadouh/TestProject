<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseMessages;
use App\Http\Requests\StoreTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Collection;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = $this->getItems();

        // dd($data['items']);
        if (request()->ajax()) {
            return $this->getDataTable($data['items']);
        }
        $data['attributes'] = Truck::getReadables();
        $data['title'] = 'View Trucks';
        $data['route'] = 'trucks';
        $data['createLink'] = route("trucks.create");

        return view('index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add a truck';
        $data['writables'] = Truck::getWritables();
        $data['actionLink'] = route("trucks.store");
        return view('edit-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTruckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTruckRequest $request)
    {
        Truck::create($request->validated());
        return redirect()->route('trucks.index')->with('success', ResponseMessages::INSERTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $data['item'] = $truck;
        $data['title'] = 'Edit a truck';
        $data['writables'] = Truck::getWritables();
        $data['actionLink'] = route("trucks.update", $truck->id);
        return view('edit-create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTruckRequest  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTruckRequest $request, Truck $truck)
    {
       $truck->update($request->validated());
return redirect()->route('trucks.index')->with('success', ResponseMessages::UPDATED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
         return response(ResponseMessages::DELETED);

    }

    private function getDataTable($items)
    {
        return \DataTables::of($items)
            ->addColumn('Actions', function ($item) {
                $data['item'] = $item;
                $data['editLink'] = route('trucks.edit', $item->id);
                $data['deleteLink'] = route('trucks.destroy', $item->id);
                return view('custom-components.btns.actions', $data);
            })

            ->rawColumns(['Actions'])
            ->make(true);
    }

     private function getItems()
    {
        return Collection::make(Truck::all())->map(function ($item) {
            $item->setAttribute('type', $item->truckType->type_name);
            return $item;
        });
    }
}
