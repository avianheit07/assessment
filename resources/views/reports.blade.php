@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="mt-0 mb-3 header-title">{{ __('Journals for :name', ['name' => $store->brand->name]) }}</h4>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Revenue</th>
                                <th scope="col">Food Cost</th>
                                <th scope="col">Labor Cost</th>
                                <th scope="col">Profit</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse ($journals as $journal)
                            <tr>
                                <th scope="row">{{ $journal->date }}</th>
                                <td>{{ $journal->revenue }}</td>
                                <td>{{ $journal->food_cost }}</td>
                                <td>{{ $journal->labor_cost }}</td>
                                <td>{{ $journal->profit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" align="center">{{ __('m_deposit_list.no records') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- pagination -->
                <div class="d-flex justify-content-end mt-3">
                    <nav aria-label="Page navigation">
                        {!! $journals->links('pagination::bootstrap-4') !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
