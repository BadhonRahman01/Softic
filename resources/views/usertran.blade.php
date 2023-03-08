@extends('layouts.app')
@section('title', 'Transaction List')
@section('content')
<div class="row px-3">
    <div class="col-lg-12 margin-tb py-3">
        <div class="pull-left">
            <h2 style="font-weight:bold;">Your Add Money History</h2>
                        <h1> My Total Money: {{$total_money}}</h1>
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
        <th>ID</th>
        <th> Amount </th>
        <th>Date</th>

    </tr>
    @foreach ($transactions as $trans)
    <tr>
        <td>{{ $trans->id }}</td>
        <td>{{ $trans->amount }}</td>
        <td>{{date('d-m-Y', strtotime($trans->created_at))}}</td>
    </tr>
    @endforeach
</table>





@endsection