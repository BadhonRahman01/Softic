@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello Normal User!
                    
                </div>
            </div>
            <button type="button" class="btn btn-success" onclick="window.location='{{ url('/home/transactions.create') }}'">Add Money</button>
            <button type="button" class="btn btn-warning">See All Transactions</button>

            {{-- addmoney --}}

                    <div class="justify-content-center">
                        <h2 style="font-weight:bold;margin-left:32px;padding-top:50px;text-align:center;">Add Money</h2>
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
               
            <form action="{{ route('home.addmoney') }}" class="px-5 d-flex justify-content-center" method="POST">
                @csrf
              
                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 " style="width: 100%">
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

            {{-- endaddmoney --}}
        </div>
    </div>
</div>
@endsection