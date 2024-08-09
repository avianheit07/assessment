@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($stores as $store)
                            <div class="col-sm-6 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $store->brand->name }}</h5>
                                        <p class="card-text"><strong>Number:</strong> {{ $store->number }}.</p>
                                        <p class="card-text"><strong>Address:</strong> {{ $store->address }}</p>
                                        <p class="card-text"><strong>Color:</strong> {{ $store->brand->color }}</p>
                                        <a href="{{ route('stores.show', ['storeId' => $store->id])}}" class="btn btn-primary">Visit store</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
