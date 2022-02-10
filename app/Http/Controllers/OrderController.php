<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Order::create([
            'customer_id'=>$request->customer_id,
            'shiping_id'=>$request->shiping_id,
            'supplier_id'=>$request->supplier_id,
            'payment_id'=>$request->payment_id,
            "created_at"  => Carbon::now(),
            "updated_at"  => now(),
        ]);
        $message = "Vendor Added Successfully ";
        return response()->json($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return Order::find($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->updated([
            'customer_id'=>$request->customer_id,
            'shiping_id'=>$request->shiping_id,
            'supplier_id'=>$request->supplier_id,
            'payment_id'=>$request->payment_id,
            "created_at"  => Carbon::now(),
            "updated_at"  => now(),
        ]);
        $message = "Vendor Added Successfully ";
        return response()->json($message, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response('Successfully Deleted.');
    }
}
