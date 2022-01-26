<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseMessages;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['items'] = $this->getItems();
        if (request()->ajax()) {
            return $this->getDataTable($data['items']);
        }
        $data['attributes'] = Order::getReadables();
        $data['title'] = 'View Orders';
        $data['createLink'] = route("orders.create");

        return view('index', $data);

    }
    private function getDataTable($items)
    {
        return \DataTables::of($items)
            // ->addColumn('Actions', function ($item) {
            //     $data['item'] = $item;
            //     $data['editLink'] = route('orders.edit', $item->id);
            //     $data['deleteLink'] = route('orders.destroy', $item->id);
            //     return view('custom-components.btns.actions', $data);
            // })

            ->rawColumns([''])
            ->make(true);
    }
    private function getItems()
    {
        return Collection::make(Order::with('truck')->get())->map(function ($item) {
            $item->setAttribute('type', $item->truck->truckType->type_name);
            $item->setAttribute('truck_id', $item->truck->license);
            return $item;
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add an Order';
        $data['writables'] = Order::getWritables();
        $data['actionLink'] = route("orders.store");
        return view('orders.edit-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        if ($this->truck_is_smaller_than_items($request))
            return back()->with('error', 'The total of items sizes is greater than truck\'s Size');

        try {
            DB::beginTransaction();
            $order = Order::create($this->getOrderData($request));
            $this->storeItemData($request, $order);
            DB::commit();
            return redirect()->route('orders.index')->with('success', ResponseMessages::INSERTED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', ResponseMessages::SOMETHING_ERROR);
        }
    }


    private function storeItemData($request, $order)
    {

        foreach ($request['item_name'] as $key => $value) {
            $itemData['name'] = $request->item_name[$key];
            $itemData['qty'] = $request->qty[$key];
            $itemData['width'] = $request->width[$key];
            $itemData['height'] = $request->height[$key];
            $itemData['depth'] = $request->depth[$key];
            $itemData['order_id'] = $order->id;
            Item::create($itemData);
        }
    }
    private function getOrderData($request)
    {
        $data['sender_name'] = $request->sender_name;
        $data['reciever_name'] = $request->reciever_name;
        $data['truck_id'] = $request->truck_id;
        return $data;
    }

    private function truck_is_smaller_than_items($request)
    {
        $truckSize = $this->getTruckSize($request->truck_id);
        $sizesSum = $this->getAllItemsSize($request);

        return $truckSize < $sizesSum;
    }
    private function getAllItemsSize($request)
    {
        foreach ($request->item_name as $key => $value) {
            $sizes[] = $request->width[$key] * $request->depth[$key] * $request->height[$key] * $request->qty[$key];
        }
        return $sizesSum = array_sum($sizes);

    }
    private function getTruckSize($truckId)
    {
        $truck = Truck::findOrFail($truckId);
        return $truck->width * $truck->depth * $truck->height;
    }

}
