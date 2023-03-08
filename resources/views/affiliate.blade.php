@extends('layouts.affsidebar')

@section('content')
    
<h1 style="text-align: center;margin-top:50px">Welcome Affiliate! </h1>


<h2 style="text-align: center;margin-top:50px;">All Commission History</h2>

<table class="table table-success table-striped">
    <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Commission Added From</th>
          <th scope="col">Ammount Added by User</th>
          <th scope="col">Commission Amount</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transactions as $tran)
        @foreach ($users as $user)
        @if ($user->id == $tran->user_id)
            @if($user->promo_code == $aff)
            <tr>
                <th scope="row">{{$tran->id}}</th>
                <td>
                    @if ($tran->subaffiliate_commission == null)
                        User(ID:{{$tran->user_id}})
                    @else
                        Sub-Affiliate
                    @endif
                </td>
                <td>{{$tran->amount}}</td>
                <td>{{$tran->affilate_commission}}</td>
                <td>{{date('d-m-Y', strtotime($tran->created_at))}}</td>
              </tr>
            @endif
        @endif
            
        @endforeach

        @endforeach
      </tbody>
  </table>


@endsection