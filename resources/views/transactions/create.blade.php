@extends('layouts.app')
@section('title', 'Add money')
@section('content')
<div class="row px-3">
    <div class="col-lg-12 margin-tb py-3">
        <div class="pull-left">
            <h2 style="font-weight:bold;margin-left:32px;">Add Money</h2>
        </div>
        <div class="pull-right" style="float: right;margin-right:35px;">
            <a class="btn btn-primary" href="{{ url()->previous() }}">Go Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('transactions.store') }}" class="px-5 d-flex" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 " style="width: 50%">
            <div class="form-group">
                <strong>Amount:</strong>
                <input type="number" name="amount" class="form-control" placeholder="Enter Your Amount" value="{{ old('amount') }}" required>
            </div>
        </div>

        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
        <div class="col-xs-12 col-sm-12 col-md-12 text-center my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>