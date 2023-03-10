@extends('layouts.app')
@section('title', 'Transaction List')
@section('content')
<div class="row px-3">
    <div class="col-lg-12 margin-tb py-3">
        <div class="pull-left">
            <h2 style="font-weight:bold;">All Transaction List</h2>
        </div>

    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered p-5">
    <tr>
        <th>#</th>
        <th> ID </th>
        <th> Amount </th>
        <th>User ID</th>
        <th>Affiliate Commission</th>
        <th>Sub-Affiliate Commission</th>
    </tr>
    @foreach ($transactions as $trans)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $trans->id }}</td>
        <td>{{ $trans->amount }}</td>
        <td>{{ $trans->user_id }}</td>
        <td>{{ $trans->affilate_commission }}</td>
        <td>{{ $trans->subaffiliate_commission }}</td>
    </tr>
    @endforeach
</table>



{!! $transactions->links() !!}

@endsection