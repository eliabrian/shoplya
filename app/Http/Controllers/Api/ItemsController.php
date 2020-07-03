<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Item;
use App\Lists;
use Illuminate\Http\Request;
use App\Http\Resources\Item as ItemResource;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lists $list)
    {
        return ItemResource::collection($list->items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'lists_id' => ['exists:lists,id']
        ]);

        $validated = [
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'lists_id' => $data['lists_id']
        ];

        $item = Item::create($validated);
        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
