<?php

namespace App\Services;

use App\Repositories\ItemRepository;

class ItemService {
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getAllItems(){
        return $this->itemRepository->all();
    }

    public function getItemByName(String $slug){
        return $this->itemRepository->findByItem($slug);
    }

    public function createItem(array $data){
        return $this->itemRepository->create($data);
    }

    public function updateItem(String $item, array $data){
        $items = $this->itemRepository->findByItem($item);
        return $this->itemRepository->update($items, $data);
    }

    public function deleteItem(String $slug){
        $items = $this->itemRepository->findByItem($slug);
        return $this->itemRepository->delete($items);
    }
}