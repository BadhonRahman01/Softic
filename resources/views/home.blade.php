

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
            {{-- <button type="button" class="btn btn-success" onclick="window.location='{{ url('/home/transactions.create') }}'">Add Money</button> --}}
            <button type="button" class="btn btn-warning" onclick="window.location='{{ url('/home/transactions/mylist') }}'">See All Transactions</button>
            <h1> My Total Money: {{$total_money}}</h1>
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
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
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
                <h2 style="text-align: center;margin-top:50px;">Transactions History</h2>

                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($trans as $tran)
                        <tr>
                            <th scope="row">{{$tran->id}}</th>
                            <td>{{$tran->amount}}</td>
                            <td>{{date('d-m-Y', strtotime($tran->created_at))}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
        </div>
    </div>
</div>
@endsection