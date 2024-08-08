<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository extends BaseRepository
{
    public function __construct(Store $store)
    {
        $this->setModel($store);
    }
}