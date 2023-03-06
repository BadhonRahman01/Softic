<style>

    .mbt{
    margin-top: 15px;
    margin-bottom: 15px;
    }
    
    </style>
    
    
    @extends('layouts.sidebar')
    @section('title', 'Create Affiliate')
    @section('content')
    
    <div class="row px-3">
        <div class="col-lg-12 margin-tb py-3">
            <div class="pull-left">
                <h2 style="font-weight:bold;margin-left:32px;">Create a New Affiliate</h2>
            </div>
            <div class="pull-right" style="float: right;margin-right:35px;">
                <a class="btn btn-primary" href="{{ route('affiliates.index') }}">Go Back</a>
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
       
    <form action="{{ route('affiliates.store') }}" class="px-5 d-flex" method="POST">
        @csrf
      
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 " style="width: 50%">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 " style="width: 50%">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mbt">
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="width: 50%;">
                <div class="form-group">
                    <strong>Commission Money:</strong>
                        Commission Money is defualt 0
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="width: 50%">
                <div class="form-group">
                    <strong>Promo Code:</strong>
                    Promo Code will be auto generated(Length=10)
                </div>
            </div>
            <div class="mbt">
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                </div>
            </div>
            <div class="mbt">
                
            </div>
            <input type="hidden" name="promo" id="promo" value="promo" />
            <input type="hidden" name="commission_money" id="commission_money" value=0 />
            <div class="col-xs-12 col-sm-12 col-md-12 text-center my-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
       
    </form>
    
    
    @endsection