<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@extends('layouts.sidebar')
@section('title', 'Affiliates List')
@section('content')

<div class="row px-3">
    <div class="col-lg-12 margin-tb py-3">
        <div class="pull-left">
            <h2 style="font-weight:bold;">Affiliate LIST</h2>
        </div>
        <div class="pull-right" style="float: right;">
            <a class="btn btn-success" href="{{ route('affiliates.create') }}"> Create Affiliate</a>
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
        <th>Name</th>
        <th>Email</th>
        <th>Total Commission Money</th>
        <th>Promo </th>
        <th >Action</th>
    </tr>
    @foreach ($affiliates as $aff)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $aff->id }}</td>
        <td>{{ $aff->name }}</td>
        <td>{{ $aff->email }}</td>
        <td>{{ $aff->commission_money }}</td>
        <td>{{ $aff->promo }}</td>
        <td style="text-align:center;">
            <form action="{{ route('affiliates.destroy',$aff->id) }}" method="POST">
                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>



{!! $affiliates->links() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>





@endsection