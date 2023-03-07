@extends('layouts.app')
@section('title', 'Transaction List')
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered p-5">
    <tr>
        <th>#</th>
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
        <td>{{ $trans->subaffilate_commission }}</td>
    </tr>
    @endforeach
</table>



{!! $transactions->links() !!}

@endsection