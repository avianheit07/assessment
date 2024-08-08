<?php

namespace App\Http\Controllers;

use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private StoreRepository $repository;

    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    public function show($id)
    {
        $store = $this->repository->getById($id, ['brand']);
        
        // Store the selected store in the session or some other state management
        session(['selected_store' => $store->id]);

        // Pass the store to the view
        return view('store.show', compact('store'));
    }
}
