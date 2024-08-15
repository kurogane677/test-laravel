<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository {
    public function all(){
        return Item::all();
    }

    public function findByItem(String $slug){
        return Item::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data){
        return Item::create($data);
    }

    public function update(Item $item, array $data){
        $item->update($data);
        return $item;
    }

    public function delete(Item $item){
        return $item->delete();
    }
}