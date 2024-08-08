<?php

namespace App\Http\Controllers;

use App\Queries\StoreQuery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $query;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StoreQuery $query)
    {
        $this->query = $query;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $stores = $this->query->setFilters(
            $request->merge(['user_id' => $request->user()->id])->all()
        )->query(['brand'])->paginate();
        return view('home', compact('stores'));
    }
}
