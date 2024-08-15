<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{

    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $items = $this->itemService->getAllItems();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:items,name',
            'description' => 'nullable|string'
        ]);

        $this->itemService->createItem($data);
        return redirect()->route('items.index')->with('success','Item created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $item = $this->itemService->getItemByName($slug);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $item = $this->itemService->getItemByName($slug);
        return view('items.create', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $item = $this->itemService->getItemByName($slug);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('items', 'name')->ignore($item->id)
            ],
            'description' => 'nullable|string'
        ]);

        $this->itemService->updateItem($slug, $data);
        return redirect()->route('items.index')->with('Success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $this->itemService->deleteItem($slug);
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
