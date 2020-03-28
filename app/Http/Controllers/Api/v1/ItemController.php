<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ItemResource;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $item = new Item();
        $query = $item->newQuery()
            ->ofType($request->get('type'))
            ->ofCode($request->get('code'))
            ->ofName($request->get('name'))
            ->latest('updated_at');

        if ($request->has('no_paged')) {
            $items = $query->get();
        } else {
            $items = $query->paginate($request->get('per_page'));
        }

        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ItemResource
     */
    public function store(StoreItemRequest $request)
    {
        $item = new Item;
        $item->fill($request->validated());
        $item->save();

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Item $item
     * @return ItemResource
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item $item
     * @return ItemResource
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->fill($request->validated());
        $item->save();

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json('', 204);
    }
}