<?php

namespace App\Http\Controllers;

use App\Queries\ReportQuery;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportQuery $query;
    protected StoreRepository $repository;

    public function __construct(StoreRepository $repository, ReportQuery $query)
    {
        $this->repository = $repository;
        $this->query      = $query; 
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!session()->has('selected_store')) {
            return redirect('/home')->with('error', 'Need to select a store first to view reports.');
        }

        if (!$store = $this->repository->getById(session('selected_store'), ['brand'])) {
            return redirect('/home')->with('error', 'Selected store not found.');
        }

        $journals = $this->query->setFilters(
            $request->merge(['store_id' => $request->user()->id])->all()
        )->query()->paginate();

        return view('/reports', compact('journals', 'store'));
    }
}
