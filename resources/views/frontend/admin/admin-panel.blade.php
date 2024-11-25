@extends('frontend.admin_panel')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>User Name</th>
            <th>Status</th>
            <th>Order Number</th>
            <th>Coupon Code</th>
            <th>Total</th>
            <th>Discount</th>
            <th width="100px">Action</th>
        </tr>
    </thead>

    <tbody>

    </tbody>

</table>
@endsection

@push('styles')

<script >

$(document).ready( function(){

var table = $('.data-table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('admin.panel') }}",
columns: [
    {data: 'id', name: 'id'},
    {data: 'user_name', name: 'User name'},
    {data: 'order_status', name: 'Status'},
    {data: 'order_number', name: 'order_number'},
    {data: 'coupon.coupon_code', name: 'coupon_code'},
    {data: 'total_price', name: 'total_price'},
    {data: 'discount', name: 'discount'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
]
});

$(document).on('click','.editButton', function(darta){
    var id = $(this).data('key');
    var status = $(this).parents('tr').find('select').val();
    console.log(status);
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    $.ajax({
        url: "{{ route('statusUpdate') }}",
        type: 'Post',
        data:{
            id:id,status:status
        },
        success: function(response) {
            table.ajax.reload();
        }
    })
});
// $.ajax({
//     url: "{{ route('statusUpdate') }}",
//     type: 'Post',
//     data:{
//         id:id,status:status
//     }
//     success: function(response) {

//     }
// })
});

</script>
@endpush
